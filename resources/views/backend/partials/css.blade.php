<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ setting('site_name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('storage/' . setting('favicon')) }}"  type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/cpwqa8rgltfovkv6h0d26y2drh0vahq4hbb4ryg9wypamins/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

    <!-- Fonts and icons -->
    <script src="{{asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{asset('backend/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{asset('backend/assets/css/kaiadmin.min.css') }}" />


    <link rel="stylesheet" href="{{asset('backend/assets/css/demo.css') }}"/>


</head>
