<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Wizards</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <!-- for dropdown -->
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



    <style>
    .wizard > .content > .body position: relative;
    }
    </style>

</head>


<body>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Wizard with Validation</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h2>
                                Sell A Book
                            </h2>
                    <p>
                        This example show how to use Steps with jQuery Validation plugin.
                    </p>

                    <form id="form" action="#" class="wizard-big">
                        <h1>Textbook</h1>
                        <fieldset>
                            <h2>Textbook Information</h2>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>ISBN</label>
                                        <input id="isbn" name="isbn" type="text" class="form-control required" value="hello">
                                    </div>
                                    <div class="form-group">
                                        <label>Title of Book</label>
                                        <input id="title" name="title" type="text" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <label>Edition</label>
                                        <input id="edition" name="edition" type="text" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <label>Author</label>
                                        <input id="author" name="author" type="text" class="form-control required">
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <h1>Course</h1>
                        <fieldset>
                            <h2>Course Information</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Course Name (i.e. Multivariable Calculus)</label>
                                        <input id="courseName" name="courseName" type="text" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <label>Course Number (i.e. Math 212) </label>
                                        <input id="courseNumber" name="courseNumber" type="text" class="form-control required">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h1>Book Condition</h1>
                        <fieldset>
                            <div class="form-group">
                                <label>Condition</label>
                                <div>
                                    <select>
                                        <option value="used">New</option>
                                        <option value="veryGood">Very Good</option>
                                        <option value="good">Good</option>
                                        <option value="fair">Fair</option>
                                        <option value="poor">Poor</option>
                                        <option value="unc">UNC Crapple Hill</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Notes</label>
                                <input id="notes" name="notes" type="text" class="form-control">
                            </div>
                        </fieldset>

                        <h1>Price</h1>
                        <fieldset>
                            <label>Price</label>
                            <input id="price" name="price" type="text" class="form-control">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="js/plugins/staps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>

    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Select2 -->
    <script src="js/plugins/select2/select2.full.min.js"></script>


    <script>
        $(document).ready(function () {
            $('.chosen-select').chosen({
                width: "100%"
            });
            
            $('input[type=text].isbn').val("sup");
            //alert($("#isbn").val());
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex) {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex) {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                },
                onFinishing: function (event, currentIndex) {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex) {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                errorPlacement: function (error, element) {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });
        });
    </script>

</body>

</html>