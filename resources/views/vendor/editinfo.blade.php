<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Campus Ambassador | Wissenaire</title>

		<!-- Bootstrap CSS -->
		
		<link rel=stylesheet href="css/stars.css">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" type="text/css">
		<link rel="stylesheet" href="{{ url('style.css') }}">
		<link rel="stylesheet" href="{{ url('css/animate.min.css') }}" type="text/css">

		<script type="text/javascript" src="{{ url('js/modernizr.js')}}"></script>
	<style>
		.main-container{
			height:100vh;
		}
        .container-fluid{
            z-index:1000;
            padding-top:20px;
        }
        label{
            color:#c0c0c0;
        }
	</style>
	</head>
	<body>
		
		
		<div class="main-container">

		<div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="editinfo"
              method="post" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            @foreach($dataTypeContent as $dataTypeContent)
                            <div class="form-group">
                                    <label for="WissID">{{ __('WissID') }}</label>
                                    <input type="text" class="form-control" id="wissid" name="wissid" placeholder="{{ __('') }}"
                                           value="{{ $dataTypeContent->WissID ?? '' }}" readonly>
                                </div>
                            
                            <div class="form-group">
                                <label for="name">{{ __('voyager::generic.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('voyager::generic.name') }}"
                                       value="{{ $dataTypeContent->name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('voyager::generic.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                       value="{{ $dataTypeContent->email ?? '' }}">
                            </div>

                            <div class="form-group">
                                    <label for="college">{{ __('College') }}</label>
                                    <input type="text" class="form-control" id="college" name="college" placeholder="{{ __('') }}"
                                           value="{{ $dataTypeContent->college ?? '' }}" required>
                                </div>
                            <div class="form-group">
                                    <label for="mobile">{{ __('Mobile no') }}</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{ __('') }}"
                                           value="{{ $dataTypeContent->mobile ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="course pursuing">{{ __('course pursuing') }}</label>
                                    <input type="text" class="form-control" id="course" name="course" placeholder="{{ __('') }}"
                                           value="{{ $dataTypeContent->course ?? '' }}" required>
                                </div>
                           @endforeach  
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('save') }}
            </button>
        </form>

       
    </div>

			<div class="stars"></div>
			<div class="twinkling"></div>
			<div class="clouds"></div>
			
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		<script type="text/javascript" src="js/plugins.js"></script>
		<script type="text/javascript" src="js/photoswipe.min.js"></script>
		<script type="text/javascript" src="js/photoswipe-ui-default.min.js"></script>
		<script type="text/javascript" src="js/photoswipe-main.js"></script>

		<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>