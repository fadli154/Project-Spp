<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
    @include('sweetalert::alert')
    <section class="section ">
        <div class="container mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="text-dark p-2 pt-3">Start Page</h3>
                        </div>

                        <div class="card-body">
                            <a href="/login">login</a>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright © XI RPL
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.script')
</body>

</html>
