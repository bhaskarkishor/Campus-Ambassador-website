@extends('voyager::master')

@section('css')
<style>
        .fb-post{
          max-height:600px;
          overflow:hidden; 
        }
        .overlay{
        
        }
        </style>    
@stop

@section('page_header')
<div class="page-title">
Facebook Page
</div>
@endsection

@section('content')

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=498414467649670&autoLogAppEvents=1"></script>

<div class="container">
<div class="row">

<?php foreach($data as $data): ?>
{{--
@if($data->id == 1)
    @continue($post[0]->post1 == 1)

    @elseif($data->id == 2)
        @continue($post[0]->post2 == 1)
    
    @elseif($data->id == 3)
        @continue($post[0]->post3 == 1) 
    
    @elseif($data->id == 3)
    @continue($post[0]->post4 == 1) 
   
    @elseif($data->id == 4)
    @continue($post[0]->post4 == 1) 
   
    @elseif($data->id == 5)
    @continue($post[0]->post5 == 1) 
    
    @elseif($data->id == 7)
    @continue($post[0]->post7 == 1) 
    
    @elseif($data->id == 8)
    @continue($post[0]->post8 == 1) 

    @elseif($data->id == 9)
    @continue($post[0]->post9 == 1) 

    @elseif($data->id == 10)
    @continue($post[0]->post10 == 1) 

    @elseif($data->id == 10)
    @continue($post[0]->post10 == 1) 
@endif
--}}
<div class="col-md-6">
        <div class="fb-post">
                <div>
                        <div class="fb-post" data-href="
                        <?php 
                        echo $data->post;
                        ?>" data-width="500" data-show-text="true"><blockquote cite="https://developers.facebook.com/wissenaireiitbbs/posts/2349104828468592:0" class="fb-xfbml-parse-ignore"><p>Let us honour the valiant heroes who made us proud and mighty nation and celebrate the bond of love with all your...</p>Posted by <a href="https://www.facebook.com/wissenaireiitbbs/">Wissenaire, IIT Bhubaneswar</a> on&nbsp;<a href="https://developers.facebook.com/wissenaireiitbbs/posts/2349104828468592:0">Wednesday, 14 August 2019</a></blockquote></div>    
                </div>
        </div>  
        <div class="overlay">
            <button class="btn btn-primary" id="sharebtn<?php echo $data->id; ?>">
            Share
            </button>
        </div>
        
</div>

<script>
document.getElementById('sharebtn<?php echo $data->id; ?>').onclick = function() {
    FB.ui({
        method: 'share',
        mobile_iframe: true,
        href: '<?php echo $data->post; ?>',
      }, 
      function(response){
        if (response == undefined){
            new swal({
            title: 'Error',
            text: 'You have not shared the post',
            icon: 'error'
            });
            }else{
            new swal({
            title: 'Post Shared',
            text: 'Thanks for sharing our post',
            icon: 'success'
            });

            const Url='{{ env('APP_URL') }}/dashboard/increase/post<?php echo $data->id; ?>';
            $.ajax({
                url:Url,
                type:"GET",
                success:function(result){
                    console.log(result);
                    document.location.reload(true);
                }
            })
            }   
      });
}
</script>
<?php endforeach ?>
</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

