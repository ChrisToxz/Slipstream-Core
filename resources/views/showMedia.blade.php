@if($tag->isVideo)
    <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    <style>
        .vjs-theme-slipstream{
            --vjs-theme-slipstream--primary:#bf3b4d;
            --vjs-theme-slipstream--secondary:#fff
        }
        .vjs-theme-slipstream .vjs-control-bar{
            height:70px;
            padding-top:20px;
            background:none;
            background-image:linear-gradient(0deg,#000,transparent)
        }
        .vjs-theme-slipstream .vjs-button>.vjs-icon-placeholder:before{
            line-height:50px
        }
        .vjs-theme-slipstream .vjs-play-progress:before{
            display:none
        }
        .vjs-theme-slipstream .vjs-progress-control{
            position:absolute;
            top:0;
            right:0;
            left:0;
            width:100%;
            height:20px
        }
        .vjs-theme-slipstream .vjs-progress-control .vjs-progress-holder{
            position:absolute;
            top:20px;
            right:0;
            left:0;
            width:100%;
            margin:0
        }
        .vjs-theme-slipstream .vjs-play-progress{
            background-color:var(--vjs-theme-slipstream--primary)
        }
        .vjs-theme-slipstream .vjs-remaining-time{
            order:1;
            line-height:50px;
            flex:3;
            text-align:left
        }
        .vjs-theme-slipstream .vjs-play-control{
            order:2;
            flex:8;
            font-size:1.75em
        }
        .vjs-theme-slipstream .vjs-fullscreen-control,.vjs-theme-slipstream .vjs-picture-in-picture-control,.vjs-theme-slipstream .vjs-volume-panel{
            order:3;
            flex:1
        }
        .vjs-theme-slipstream .vjs-volume-panel:hover .vjs-volume-control.vjs-volume-horizontal{
            height:100%
        }
        .vjs-theme-slipstream .vjs-mute-control{
            display:none
        }
        .vjs-theme-slipstream .vjs-volume-panel{
            margin-left:.5em;
            margin-right:.5em;
            padding-top:1.5em
        }
        .vjs-theme-slipstream .vjs-volume-bar.vjs-slider-horizontal,.vjs-theme-slipstream .vjs-volume-panel,.vjs-theme-slipstream .vjs-volume-panel.vjs-volume-panel-horizontal:hover,.vjs-theme-slipstream .vjs-volume-panel:active .vjs-volume-control.vjs-volume-horizontal,.vjs-theme-slipstream .vjs-volume-panel:focus .vjs-volume-control.vjs-volume-horizontal,.vjs-theme-slipstream .vjs-volume-panel:hover,.vjs-theme-slipstream .vjs-volume-panel:hover .vjs-volume-control.vjs-volume-horizontal{
            width:3em
        }
        .vjs-theme-slipstream .vjs-volume-level:before{
            font-size:1em
        }
        .vjs-theme-slipstream .vjs-volume-panel .vjs-volume-control{
            opacity:1;
            width:100%;
            height:100%
        }
        .vjs-theme-slipstream .vjs-volume-bar{
            background-color:transparent;
            margin:0
        }
        .vjs-theme-slipstream .vjs-slider-horizontal .vjs-volume-level{
            height:100%
        }
        .vjs-theme-slipstream .vjs-volume-bar.vjs-slider-horizontal{
            margin-top:0;
            margin-bottom:0;
            height:100%
        }
        .vjs-theme-slipstream .vjs-volume-bar:before{
            content:"";
            z-index:0;
            width:0;
            height:0;
            position:absolute;
            top:0;
            left:0;
            border-color:transparent transparent hsla(0,0%,100%,.25);
            border-style:solid;
            border-width:0 0 1.75em 3em
        }
        .vjs-theme-slipstream .vjs-volume-level{
            overflow:hidden;
            background-color:transparent
        }
        .vjs-theme-slipstream .vjs-volume-level:before{
            content:"";
            z-index:1;
            width:0;
            height:0;
            position:absolute;
            top:0;
            left:0;
            border-left:3em solid transparent;
            border-bottom:1.75em solid var(--vjs-theme-slipstream--secondary);
            border-right:0 solid transparent;
            border-top:0 solid transparent
        }

    </style>
    <video
        id="media"
        class="video-js vjs-big-play-centered vjs-theme-slipstream"
        controls
        preload="auto"
        width="1280"
        height="528"
{{--        poster="MY_VIDEO_POSTER.jpg"--}}
        data-setup="{}"
    >
        <source src="{{url('storage/media/'.$tag->tag.'/'.$tag->media->original)}}" type="video/mp4">
    </video>
    <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
@elseif($tag->isImage)
<img src="{{url('storage/media/'.$tag->tag.'/'.$tag->media->original)}}"/>
@endif
