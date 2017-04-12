/// <reference path="../jquery.min.js" />

//force strict mode
"use strict";

/* Modal Video pluggin.
 * currently handles videos in mp4 using html5 native controls && youtube videos
 * currently handles modal click events 
 */

//scope safe constructor
function ModalVideoOptions(callbackOnModalOpenClick) {
    if (this instanceof ModalVideoOptions) {

        this.callbackOnModalOpenClick = callbackOnModalOpenClick;
        this._videoType = undefined;

        //we freeze the object if possible
        if (Object.freeze)
            Object.freeze(this.VideoEnum);   
    }

    else {
        return new ModalVideoOptions(callbackOnModalOpenClick);
    }
}

ModalVideoOptions.prototype = {
    constructor: ModalVideoOptions,

    //getters and setters for videoType

    getVideoType : function () {
        return this._videoType;
    },

    setVideoType : function (value) {
        if (typeof value != "number") {
            throw new Error('Invalid argument: value. This argument must be a number.');
        }

        var videoTypeItem;
        //loop in the enum properties
        for(videoTypeItem in this.VideoEnum) {
            var enumValue = this.VideoEnum[videoTypeItem];

            if (value == enumValue) {
                this._videoType = enumValue;
            }
        }

        if (this._videoType == undefined)
            throw new Error('Invalid argument: value. This argument must be in the range of VideoEnum.');
    },

    //enum 

    VideoEnum : {
        MP4: 0,
        YOUTUBE: 1
    }
};

/**
 * JavaScript function to match (and return) the video Id 
 * of any valid Youtube Url, given as input string.
 * @author: Stephan Schmitz <eyecatchup@gmail.com>
 * @url: http://stackoverflow.com/a/10315969/624466
 */
function ytVidId(url) {
    var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    return (url.match(p)) ? RegExp.$1 : false;
}

(function ($) {
    
    function showModal(options) {
        
        //mask doesn't exist
        if ($('#mask').length == 0) {
            //we create it
            $('body').prepend("<div id='mask' class='modal-backdrop fade in'></div>");
        }

        var dialogContainer = $('#dialog-container-video');

        //popup not created yet
        if (dialogContainer.length == 0) {

            //we create it
            var dialogContainer = $("<div id='dialog-container-video' class='modal fade in'></div>");
            $('body').prepend(dialogContainer);

        }

        var dialogContent;

        if (options.getVideoType() == options.VideoEnum.MP4)
            dialogContent = "<div id='dialog-content' class='modal-body'><video width='100%' src='" + options.link + "' controls></video></div>";

        else if (options.getVideoType() == options.VideoEnum.YOUTUBE)
            dialogContent = "<div id='dialog-content' class='modal-body modal-body-video'><iframe src='https://www.youtube.com/embed/" + options.youtubeId + "' frameborder='0' allowfullscreen></iframe></div>";

        if(dialogContent)
            dialogContainer.append(dialogContent);
        
        //transition effect
        $('#mask').show();
        $("#dialog-container-video").show();

        //modal only must be visible, so we hide the scrollbars
        $('body').css('overflow', 'hidden');

        //add here transition effect to hide the modal window
        var closePopup = function () {
            $('#mask').hide();
            $('#dialog-container-video').hide();

            //we unbind at the closing of the modal window
            $("#mask").unbind("click", closePopup);
            $('#dialog-container-video a.close').unbind("click", closePopup);
            $(document).unbind("keyup", escKeyClosePopup);

            $('#dialog-content').remove();

            //we display the scrollbars again if needed
            $('body').css('overflow', 'auto');
        };

        $('#mask').on("click", closePopup);
        $('#dialog-container-video a.close').on("click", closePopup);

        var escKeyClosePopup = function (e) {
            //escape key
            if (e.keyCode == 27) {
                closePopup();
            }
        };

        $(document).keyup(escKeyClosePopup);
    }

    $.fn.modalvideo = function (options) {

        if ((options instanceof ModalVideoOptions) == false)
            throw new Error('Invalid argument: options. This argument must be an instance of ModalVideoOptions.');

        //force strong-typed object
        if (!options || $.isEmptyObject(options)) {
            options = new ModalVideoOptions();
        }

        //every link the selector found
        $(this).each(function (i) {

            //get the url of the link
            var link = $(this).prop("href");
			
            //no href property ? we leave
            if (typeof link == "undefined") {
                return true;
            }

            var youtubeId = ytVidId(link);

            //youtube id detected
            if (youtubeId != false) {
                //console.log('youtube ID : ' + youtubeId);
                options.setVideoType(options.VideoEnum.YOUTUBE);
                options.youtubeId = youtubeId;
            }

                //test if the link ends with '.mp4' 
            else if (link.indexOf('.mp4', link.length - '.mp4'.length) != -1) {
                options.setVideoType(options.VideoEnum.MP4);
            }

            //no mp4 or youtube video, continue to the next link
            else
                return true;

            options.link = typeof options.link == "undefined" ? link : options.link;

            //binding to the click event. This will cancel the trigger('click') event.
            $(this).click(function (e) {
                e.preventDefault();

                showModal(options);

                //open modal event

                if (typeof options.callbackOnModalOpenClick == "function") {
                    options.callbackOnModalOpenClick();
                }
            });

        });
    }
})(jQuery);