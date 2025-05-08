<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agent Agremeent Word and PDF file Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-head">
                        <h2 class="text-center text-semibold text-success">Fill The From for Agent Agrement and Download PDF or Word FIle</h2>
                        
                    </div>
                    <div class="card-body">
                        <form action="docx_file_modify.php" method="POST">
                            <div class="my-2">
                                <label for="name">Agent Name</label>
                                <input type="text" name="name" placeholder="Full Name" id="name"
                                    class="form-control my-1">
                            </div>
                            <div class="my-2">
                                <label for="position">Position</label>
                                <input type="text" name="position" placeholder="Your Position" id="position"
                                    class="form-control my-1">
                            </div>
                            <div class="my-2">
                                <label for="company">Company Name</label>
                                <input type="text" name="company" placeholder="Company Name" id="company"
                                    class="form-control my-1">
                            </div>
                            <div class="my-2">
                                <label for="address">Company Address</label>
                                <input type="text" name="address" placeholder="Company address" id="address"
                                    class="form-control my-1">
                            </div>
                            <div class="my-2">
                                <label for="country">Country Name</label>
                                <input type="text" name="country" placeholder="Country Name" id="country"
                                    class="form-control my-1">
                            </div>
                            <input type="submit" name="btn" class="btn btn-success btn-sm" value="Submit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>












