<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $page_title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="<?= base_url() ?>/assets/user_favicon.png" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/toastr.min.css" type="text/css">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard.php" class="logo d-flex align-items-center">
                <img src="<?= base_url() ?>/assets/user_favicon.png">
                <span class="d-none d-lg-block">Pepy</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
    </header>

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('/') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </aside>

    <main id="main" class="main">
        <div class="row">
            <div class="col-lg-6">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5 class="card-title">Create Product</h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-lg-3 col-form-label">Product Name</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="inputText">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label">Attributes</label>
                                        <div class="col-lg-6">
                                            <select data-placeholder="Nothing Selected" id="multipleSelect" multiple class="chosen-select" name="attributes">
                                                <?php
                                                $count = count($attributes);
                                                foreach ($attributes as $value) { ?>
                                                    <option value="<?= $value['attr_id'] ?>"><?= ucfirst($value['attr_name']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section" id="product_attributes" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5 class="card-title">Product Attributes</h5>
                                        </div>
                                    </div>
                                    <div id="details">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section" id="product_variation" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5 class="card-title">Product Variation</h5>
                                        </div>
                                    </div>
                                    <form action="<?= site_url('prodetails') ?>" method="post" enctype="multipart/form-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Variant</th>
                                                    <th></th>
                                                    <th scope="col">Variant Price</th>
                                                </tr>
                                            </thead>
                                            <tbody id="property_details">

                                            </tbody>
                                        </table>
                                        <div style="text-align:center">
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php
            if ($details) { ?>
                <div class="col-lg-6">
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5 class="card-title">Product Details</h5>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">S.No</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Variants</th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tbody>
                                                <?php
                                                $serialNo = 1;
                                                $prevProductId = null;
                                                foreach ($details as $row) {
                                                    $productId = $row['pro_id'];
                                                    $productName = $row['pro_name'];
                                                    $variants = $row['attr_variation_name'];
                                                    $price = $row['attr_variation_price'];
                                                    if ($productId !== $prevProductId) {
                                                        $rowspan = count(array_filter($details, function ($item) use ($productId) {
                                                            return $item['pro_id'] === $productId;
                                                        }));
                                                    } else {
                                                        $rowspan = 0;
                                                    }
                                                    echo "<tr>";
                                                    if ($rowspan > 0) {
                                                        echo "<td rowspan=$rowspan>$serialNo</td>";
                                                        echo "<td rowspan=$rowspan>$productName</td>";
                                                    }
                                                    echo "<td>$variants</td>";
                                                    echo "<td>$price</td>";
                                                    echo "</tr>";
                                                    if ($rowspan > 0) {
                                                        $serialNo++;
                                                    }
                                                    $prevProductId = $productId;
                                                }
                                                ?>
                                            </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <?php } ?>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <script type='text/javascript'>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        })

        var valuesArray = [];
        $('#multipleSelect').on("change", function() {
            var product_name = document.querySelector("#inputText").value
            if (product_name) {
                var demo = [];
                var details = "";
                var multi_select = document.querySelector("#multipleSelect").selectedOptions.length;
                $("#product_variation").hide();
                $('#multipleSelect :selected').each(function(i, sel) {
                    $('#details').empty();
                    $('#property_details').html(null);
                    var attr_id = $(sel).val();
                    var attr_value = $(sel).text();
                    $.ajax({
                        url: "<?= site_url() ?>/property",
                        method: 'POST',
                        type: 'POST',
                        data: {
                            attr_id: attr_id
                        },
                        success: function(data) {
                            $("#product_attributes").show();
                            $('#details').append(data);
                            $(".chosen_select").chosen({
                                no_results_text: "Oops, nothing found!",
                                width: "100%"
                            })

                            $('#' + attr_value).on("change", function() {
                                $("#product_variation").show();
                                $('#' + attr_value + ' option:selected').each(function(i, sel) {
                                    $('#property_details').html(null);
                                    var txt = $(sel).text()
                                    var prop = $(this).attr("property_id")
                                    demo.push({
                                        [prop]: txt
                                    })

                                    var uniqueArr = demo.reduce(function(result, obj) {
                                        var values = Object.values(obj);
                                        if (!result.some(function(item) {
                                                return Object.values(item)[0] === values[0];
                                            })) {
                                            result.push(obj);
                                        }
                                        return result;
                                    }, []);

                                    function generateCombinations(uniqueArr) {
                                        var combinations = [];
                                        var keys = [];
                                        var values = {};
                                        uniqueArr.forEach(function(obj) {
                                            var key = Object.keys(obj)[0];
                                            var value = obj[key];
                                            if (!keys.includes(key)) {
                                                keys.push(key);
                                            }
                                            values[key] = values[key] || [];
                                            values[key].push(value);
                                        });
                                        var keysCount = keys.length;
                                        for (var i = 0; i < keysCount; i++) {
                                            var currentKey = keys[i];
                                            var currentValues = values[currentKey];
                                            if (multi_select == 1) {
                                                currentValues.forEach(function(value) {
                                                    combinations.push(value);
                                                })
                                            } else if (multi_select == 2) {
                                                for (var j = i + 1; j < keysCount; j++) {
                                                    var nextKey = keys[j];
                                                    var nextValues = values[nextKey];
                                                    currentValues.forEach(function(value) {
                                                        nextValues.forEach(function(nextValue) {
                                                            combinations.push(value + '-' + nextValue);
                                                        });
                                                    });
                                                }
                                            } else if (multi_select == 3) {
                                                for (var j = i + 1; j < keysCount + 1; j++) {
                                                    var nextKey = keys[j];
                                                    var nextValues = values[nextKey];
                                                    for (var z = j + 1; z < keysCount; z++) {
                                                        var futureKey = keys[z];
                                                        var futureValues = values[futureKey];
                                                        currentValues.forEach(function(value) {
                                                            nextValues.forEach(function(nextValue) {
                                                                futureValues.forEach(function(futureValue) {
                                                                    combinations.push(value + '-' + nextValue + '-' + futureValue);
                                                                })
                                                            });
                                                        });
                                                    }
                                                }
                                            }
                                        }
                                        return combinations;
                                    }

                                    var combinations = generateCombinations(uniqueArr);
                                    details = '<tr><input type="hidden" id="attr_product_name" name="pro_name"></tr>';
                                    $('#property_details').append(details);
                                    $("#attr_product_name").val(document.querySelector("#inputText").value);
                                    combinations.forEach(function(value, index) {
                                        details = '<tr><td id="attr_variation_value' + index + '"></td><td><input type="hidden" class="form-control" id="attr_variation_name' + index + '" name="attr_variation_name[]"></td><td><input type="number" id="attr_variation_price" name="attr_variation_price[]" class="form-control" placeholder="0"></td></tr>';
                                        $('#property_details').append(details);
                                        $("#attr_variation_value" + index).text(value);
                                        $("#attr_variation_name" + index).val(value);
                                    });
                                });
                            });
                        }
                    });
                });
            } else {
                toastr.error('Kindly fill Product Name');
            }
        });
    </script>
    <script type='text/javascript'>
        <?php
        $session = \Config\Services::session();
        if (session()->getFlashdata('status') !== NULL) { ?>
            toastr.<?= session()->getFlashdata('color') ?>('<?= session()->getFlashdata('status') ?>');
        <?php
            $session->remove('color');
            $session->remove('status');
        } ?>
    </script>
</body>

</html>