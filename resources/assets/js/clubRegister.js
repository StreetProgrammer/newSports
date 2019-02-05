


///////////////////////////////////////////////////////////////////////////////////////////////////
//// start proccess of club Profile ImageFile crop in [[ register Proccess ]] to [[ store ]] //////
///////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function () {
    $clubProfileImage_crop = $('#clubProfileImage_crop').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square' //circle
        },
        boundary: {
            width: 300,
            height: 300
        }
    });
});

$(document).on('change', "#clubProfileImageFile", function () {

    var reader = new FileReader();
    reader.onload = function (event) {
        $clubProfileImage_crop.croppie('bind', {
            url: event.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    //alert('done') ;
    $('#clubProfileImageModal').modal('show');
    setTimeout(function () {
        //$('#uploadimageModal').modal('hide');
        var clubProfileImageFile = $("#clubProfileImageFile");
        clubProfileImageFile.val('');
    }, 1000);
});

//$('.crop_image').click(function(event){
$(document).on('click', ".crop_clubProfileImage", function (event) {
    //$('.imageInfo').css('opacity', '0.6');
    //$('.imageInfoLoader').fadeIn();
    $clubProfileImage_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (response) {
        $('#clubProfileImagePlaceholder').attr({
            src: response
        });
        $("input[name=user_img]").attr({
            value: response
        });
        $('#clubProfileImageModal').modal('hide');
        var clubProfileImageFile = $("#clubProfileImageFile");
        clubProfileImageFile.replaceWith(clubProfileImageFile = clubProfileImageFile.clone(true));
    })
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//// end proccess of club Profile ImageFile crop in [[ register Proccess ]] to [[ store ]] ////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
//// // start proccess of club Profile ImageFile crop in [[ register Proccess ]] to [[ update ]] //
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
    $EditclubProfileImage_crop = $('#EditclubProfileImage_crop').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square' //circle
        },
        boundary: {
            width: 300,
            height: 300
        }
    });
});
$(document).on('change', "#editClubProfileImageFile", function () {

    var reader = new FileReader();
    reader.onload = function (event) {
        $EditclubProfileImage_crop.croppie('bind', {
            url: event.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    //alert('done') ;
    $('#EditclubProfileImageModal').modal('show');
    setTimeout(function () {
        //$('#uploadimageModal').modal('hide');
        var editClubProfileImageFile = $("#editClubProfileImageFile");
        editClubProfileImageFile.val('');
    }, 1000);
});

//$('.crop_image').click(function(event){
$(document).on('click', ".crop_editClubProfileImage", function (event) {
    //$('.imageInfo').css('opacity', '0.6');
    //$('.imageInfoLoader').fadeIn();
    $EditclubProfileImage_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (response) {
        $('#editClubProfileImagePlaceholder').attr({
            src: response
        });
        $("input[name=user_img]").attr({
            value: response
        });
        $('#EditclubProfileImageModal').modal('hide');
        $('#updateClubProfileImage').fadeIn();
        var editClubProfileImageFile = $("#editClubProfileImageFile");
        editClubProfileImageFile.val('');
        editClubProfileImageFile.replaceWith(editClubProfileImageFile = editClubProfileImageFile.clone(true));
    })
});

//end proccess of club Profile ImageFile crop in [[ register Proccess ]] to [[ update ]]


// start proccess of profile image crop and upload
$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square' //circle
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$(document).on('change', "#upload", function () {

    var reader = new FileReader();
    reader.onload = function (event) {
        $image_crop.croppie('bind', {
            url: event.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    //alert('done') ;
    $('#uploadimageModal').modal('show');
});
// End proccess of profile image crop and upload

//$('.crop_image').click(function(event){
$(document).on('click', ".crop_image", function (event) {
    $('.imageInfo').css('opacity', '0.6');
    $('.imageInfoLoader').fadeIn();
    $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (response) {
        var _token = $("input[name=_token]").val();
        var clubId = $("input[name=clubId]").val();
        $.ajax({
            url: "/changeProfilePhoto/club",
            type: "POST",
            data: {
                "image": response,
                "_token": _token,
                'clubId': clubId
            },
            success: function (data) {
                var upload = $("#upload");
                upload.replaceWith(upload = upload.clone(true));
                $('#uploadimageModal').modal('hide');
                $('.imageInfo').load('/imageinfodivload/club').fadeIn('slow');
                $('.imageInfo').css('opacity', '1');
                $('.imageInfoLoader').fadeOut();
                // try to change all photos in page
                $('#updateable-1').attr('src', data.imgUrl);
                $("#updateable-2").attr("src", data.imgUrl);
                $("#updateable-3").attr("src", data.imgUrl);
                console.log(data.imgUrl);
            }
        });
    })
});



///////////////////////////////////////////////////////////////////////////////////////////////////
/////// end proccess of club Profile ImageFile crop in [[ register Proccess ]] to [[ update ]] /////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////// start validate and [[ Store ]] club profile main data [[ before register]] //////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#StoreClubMainInfo", function (e) {
    e.preventDefault();
    var errors = 0;

    var name = $("input[name=name]").val();

    if (name.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=name]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_phone = $("input[name=c_phone]").val();

    if (c_phone.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_phone]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var email = $("input[name=email]").val();

    if (email.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=email]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=email]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_city = $("select[name=c_city]").val();

    if (c_city.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_city]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_area = $("select[name=c_area]").val();

    if (c_area.replace(/\s/g, "") === "") {

        // errors = 1;
        $("select[name=c_area]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_address = $("input[name=c_address]").val();

    if (c_address.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_address]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var password = $("input[name=password]").val();

    if (password.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=password]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=password]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    if (errors === 0) {
        $('#contentChangable').css('opacity', '0.6');
        $('.Loader').fadeIn();

        $("input[name=name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=email]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=password]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        var _token = $("input[name=_token]").val();
        var user_img = $("input[name=user_img]").val();
        var type = $("input[name=type]").val();
        var user_img = $("input[name=user_img]").val();
        var c_desc = $('textarea#c_desc').val();
        $.ajax({
            type: 'POST',
            url: '/registerClub',

            data: {
                _token: _token,
                type: type,
                user_img: user_img,
                name: name,
                c_phone: c_phone,
                email: email,
                c_city: c_city,
                c_area: c_area,
                c_address: c_address,
                password: password,
                c_desc: c_desc,
            },
            success: function (data) {
                if (data.errors) {
                    console.log(data) ;
                    swal({
                        title: "Not Valid ?",
                        text: "Check Errors, and try again !!!",
                        icon: "warning",
                        dangerMode: true,
                    });
                    $('#contentChangable').css('opacity', '1');
                    $('.Loader').fadeOut();
                } else {
                    swal({
                        title: "Created",
                        text: "Club Account Main Information Created successfuly !!!",
                        icon: "success",
                        dangerMode: false,
                    });
                    //$('#clubUserName').text(data);
                    $('#contentChangable').css('opacity', '1');
                    $('.Loader').fadeOut();
                    $('#contentChangable').load('/club/editMainRegisterInfo').fadeIn('slow');
                    $('#pageTop').load('/club/registerPageTop').fadeIn('slow');
                }
                

            }
        });

    } else {

        swal({
            title: "Not Valid ?",
            text: "Check Errors, and try again !!!",
            icon: "warning",
            dangerMode: true,
        });

    }

});
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// end validate and [[ Store ]] club profile main data [[ before register]] //////////
///////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////
///start for playground image gallary in register proccess to handle it in add or edit court //////
///////////////////////////////////////////////////////////////////////////////////////////////////


// start proccess of playground images crop and prepare input value in [[ register Proccess ]] to [[ store ]]

$(document).ready(function () {
    $newPlaygroundImg = $('#newPlaygroundImgDiv').croppie({
        enableExif: true,
        viewport: {
            width: 350,
            height: 200,
            type: 'square' //circle
        },
        boundary: {
            width: 450,
            height: 300
        }
    });
});



$(document).on('change', "#newPlaygroundImageFile", function () {
    //alert('done') ;
    var reader = new FileReader();
    reader.onload = function (event) {
        $newPlaygroundImg.croppie('bind', {
            url: event.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    //alert('done') ;
    $('#newPlaygroundImageFileModal').modal('show');
    //$('#addPlaygroundImageFileModal').modal('show');
    setTimeout(function () {
        //$('#uploadimageModal').modal('hide');
        var newPlaygroundImageFile = $("#newPlaygroundImageFile");
        newPlaygroundImageFile.val('');
    }, 1000);
});
$(document).on('click', ".crop_newPlaygroundImage", function (event) {
    $newPlaygroundImg.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (response) {
        $('.newplaygroundGallaryPlaceholder').append('<div class="col-md-3 text-center" style="position: relative;display: inline-block;"><div style="padding:5px;"><img class="img img-thumbnail gallaryImg" style="width:100px" src="' + response + '"></div><span class="DelImg" style="cursor: pointer;position: absolute;top: 10px;right: 45px;color: #3c8dbc;"><i class="fa fa-times-circle"></i></span></div>');

        $('#newPlaygroundImageFileModal').modal('hide');
        var newPlaygroundImageFile = $("#newPlaygroundImageFile");
        newPlaygroundImageFile.val('') ;
        //newPlaygroundImageFile.replaceWith(newPlaygroundImageFile = newPlaygroundImageFile.clone(true));
        if ($('.gallaryImg').length > 4) {
            $('#forPlaygroundImageFile').fadeOut();
        } else {
            $('#forPlaygroundImageFile').fadeIn();
        }
    })
});

$(document).on('click', ".DelImg", function () {

    $(this).parent().remove();
    var count = $('.gallaryImg').length;
    //alert(count);
    if ($('.gallaryImg').length > 4) {
        $('#forPlaygroundImageFile').fadeOut();
    } else {
        $('#forPlaygroundImageFile').fadeIn();
    }

});

 //end proccess of playground images crop and prepare input value in [[ register Proccess ]] to [[ store ]]

 ///////////////////////////////////////////////////////////////////////////////////////////////////
 // end for playground image gallary in register proccess to handle it in add or edit court ////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////

// start proccess of playground images crop and prepare input value in [[ register Proccess ]] to [[ store ]]
$(document).ready(function () {
    $playgroundImg = $('#playgroundImgDiv').croppie({
        enableExif: true,
        viewport: {
            width: 350,
            height: 200,
            type: 'square' //circle
        },
        boundary: {
            width: 450,
            height: 300
        }
    });
});

$(document).on('change', "#addPlaygroundImageFile", function () {
    var reader = new FileReader();
    reader.onload = function (event) {
        $playgroundImg.croppie('bind', {
            url: event.target.result
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    //alert('done') ;
    $('#addPlaygroundImageFileModal').modal('show');
    setTimeout(function () {
        //$('#uploadimageModal').modal('hide');
        var addPlaygroundImageFile = $("#addPlaygroundImageFile");
        addPlaygroundImageFile.val('');
    }, 1000);
});

$(document).on('click', ".crop_playgroundImage", function (event) {
    $playgroundImg.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (response) {
        $('.playgroundGallaryPlaceholder').append('<div class="col-md-3 text-center" style="position: relative;display: inline-block;"><div style="padding:5px;"><img class="img img-thumbnail gallaryImg" style="width:100px" src="' + response + '"></div><span class="completelyDelImg" id="newPhotoAdded" style="cursor: pointer;position: absolute;top: 10px;right: 45px;color: #3c8dbc;"><i class="fa fa-times-circle"></i></span></div>');


        var _token = $("input[name=_token]").val();
        var playgroundId = $("input[name=playgroundId]").val();
        $.ajax({
            url: "/addRegisterPlaygroundPhoto",
            type: "POST",
            data: {
                "image": response,
                "_token": _token,
                'playgroundId': playgroundId
            },
            success: function (data) {
                $('#addPlaygroundImageFileModal').modal('hide');
                var addPlaygroundImageFile = $("#addPlaygroundImageFile");
                addPlaygroundImageFile.replaceWith(addPlaygroundImageFile = addPlaygroundImageFile.clone(true));
                if ($('.gallaryImg').length > 4) {
                    $('#forPlaygroundImageFile').fadeOut();
                } else {
                    $('#forPlaygroundImageFile').fadeIn();
                }
                $('#newPhotoAdded').attr('id', data);
                console.log(data.imgUrl);
            }
        });
    })
});

$(document).on('click', ".completelyDelImg", function () {
    var photoId = $(this).attr('id');
    $(this).parent().remove();
    var count = $('.gallaryImg').length;
    //alert(count);
    if ($('.gallaryImg').length > 4) {
        $('#forPlaygroundImageFile').fadeOut();
    } else {
        $('#forPlaygroundImageFile').fadeIn();
    }
    var _token = $("input[name=_token]").val();
    var PlaygroundId = $("input[name=playgroundId]").val();
    $.ajax({
        type: 'POST',
        url: '/DeleteRegisterPlaygroundPhoto',

        data: {
            _token: _token,
            PlaygroundId: PlaygroundId,
            photoId: photoId,
        },
        success: function (data) {
            console.log(data);
            //alert(data);
            swal({
                title: "Deleted",
                text: "Photo Deleted successfuly !!!",
                icon: "success",
                dangerMode: false,
            });
            $('.Loader').delay(500).fadeOut();
            //$('#contentChangable').load('/club/registerAddBranch').fadeIn('slow');
            //$('#contentChangable').fadeIn('200');
        }
    });

});

 //end proccess of playground images crop and prepare input value in [[ register Proccess ]] to [[ store ]]


////////////////////////////////////////////////////////////////////////////////////////
//////////////////////// i think it's for register /////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////
////////// start change from display playgrounds details to Add new play ground form //////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#showHidePlaygrounds", function () {

    if ($(this).hasClass("done") == false) {
        $(this).addClass("done");
        //alert('done class ADDED') ;
        $('.addNewPlayground').each(function (i, obj) {
            $(this).show(300);
        });
        $('.displayPlaygroundsDetails').each(function (i, obj) {
            $(this).fadeOut();
        });
    } else {
        $(this).removeClass("done");
        //alert('done class REMOVED') ;
        $('.displayPlaygroundsDetails').each(function (i, obj) {
            $(this).show(300);
        });
        $('.addNewPlayground').each(function (i, obj) {
            $(this).fadeOut();
        });
    }
});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////// end change from display playgrounds details to Add new play ground form //////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////
///////////// start validate and [[ Update ]] club profile main data [[ before register]] /////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#UpdateClubMainInfo", function (e) {
    e.preventDefault();
    var errors = 0;

    var name = $("input[name=name]").val();

    if (name.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=name]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_phone = $("input[name=c_phone]").val();

    if (c_phone.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_phone]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var email = $("input[name=email]").val();

    if (email.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=email]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=email]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_city = $("select[name=c_city]").val();

    if (c_city.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_city]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_area = $("select[name=c_area]").val();

    if (c_area.replace(/\s/g, "") === "") {

        // errors = 1;
        $("select[name=c_area]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_address = $("input[name=c_address]").val();

    if (c_address.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_address]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var password = $("input[name=password]").val();

    /*if(password.replace(/\s/g,"") === ""){

          errors = 1;
        $("input[name=password]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("input[name=password]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }*/

    if (errors === 0) {
        $('#contentChangable').css('opacity', '0.6');
        $('.Loader').fadeIn();

        $("input[name=name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=email]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=password]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        var _token = $("input[name=_token]").val();
        var user_img = $("input[name=user_img]").val();
        var type = $("input[name=type]").val();
        var clubId = $("input[name=clubId]").val();
        var c_desc = $('textarea#c_desc').val();
        $.ajax({
            type: 'POST',
            url: '/updateRegisterClubMainInfo',

            data: {
                _token: _token,
                type: type,
                clubId: clubId,
                name: name,
                c_phone: c_phone,
                email: email,
                c_city: c_city,
                c_area: c_area,
                c_address: c_address,
                password: password,
                c_desc: c_desc,
            },
            success: function (data) {
                //alert(data);
                swal({
                    title: "Updated",
                    text: "Club Account Main Information Updated successfuly !!!",
                    icon: "success",
                    dangerMode: false,
                });
                //$('#clubUserName').text(data);
                $('#contentChangable').css('opacity', '1');
                $('.Loader').fadeOut();
                $('#contentChangable').load('/club/editMainRegisterInfo').fadeIn('slow');
                //$('#EventGames').load('http://127.0.0.1:8000/Event/' + MainEvent + '/Games').fadeIn('slow');

            }
        });

    } else {

        swal({
            title: "Not Valid ?",
            text: "Check Errors, and try again !!!",
            icon: "warning",
            dangerMode: true,
        });

    }

});
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// end validate and [[ Update ]] club profile main data [[ before register]] ////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////start [[ Update ]] club profile image [[ before register]]//////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#updateClubProfileImage", function (e) {
    e.preventDefault();
    //alert('done');
    $('#contentChangable').css('opacity', '0.6');
    $('.Loader').fadeIn();
    var _token = $("input[name=_token]").val();
    var clubId = $("input[name=clubId]").val();
    //var clubBranchId = $("input[name=clubBranchId]").val();
    var user_img = $("input[name=user_img]").val();
    $.ajax({
        type: 'POST',
        url: '/updateRegisterClubPhoto',

        data: {
            _token: _token,
            clubId: clubId,
            //clubBranchId:clubBranchId,
            user_img: user_img,
        },
        success: function (data) {

            //alert(data);
            swal({
                title: "Updated",
                text: "Image Updated successfuly !!!",
                icon: "success",
                dangerMode: false,
            });
            //$('#clubUserName').text(data);
            $('#contentChangable').css('opacity', '1');
            $('.Loader').fadeOut();
            //$('.mainBranchInfo').load('/branches/' + clubBranchId + '/loadUpdateLogobanner/').fadeIn('slow');
            //$('#EventGames').load('http://127.0.0.1:8000/Event/' + MainEvent + '/Games').fadeIn('slow');

        }
    });

});
///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// end [[ Update ]] club profile image [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
/////////// start [[ create ]] Playground record for Club [[ before register ]] ///////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#AddNewPlaygroundRegister", function (e) {
    e.preventDefault();
    var photosArr = [];
    $('.gallaryImg').each(function () {
        //alert( $(this).attr('src') );
        photosArr.push($(this).attr('src'));
    });
    console.log(photosArr);
    //var features = $("input[name='features[]']").val();
    var features = [];

    $("input[name='features[]']:checked").each(function () {
        features.push($(this).val());
    });
    //alert(photosArr);
    console.log(photosArr);

    var errors = 0;

    var c_b_p_name = $("input[name=c_b_p_name]").val();

    if (c_b_p_name.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_name]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_phone = $("input[name=c_b_p_phone]").val();

    if (c_b_p_phone.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_phone]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_sport_id = $("select[name=c_b_p_sport_id]").val();

    if (c_b_p_sport_id.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_b_p_sport_id]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_p_sport_id]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_price_per_hour = $("input[name=c_b_p_price_per_hour]").val();

    if (c_b_p_price_per_hour.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_price_per_hour]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_price_per_hour]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_city = $("select[name=c_b_p_city]").val();

    if (c_b_p_city.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_b_p_city]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_p_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_area = $("select[name=c_b_p_area]").val();

    if (c_b_p_area.replace(/\s/g, "") === "") {

        // errors = 1;
        $("select[name=c_b_p_area]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_p_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_address = $("input[name=c_b_p_address]").val();

    if (c_b_p_address.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_address]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    if (errors === 0) {
        $('.contentChangable').css('opacity', '0.6');
        $('.Loader').fadeIn();

        $("input[name=c_b_p_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_sport_id]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_price_per_hour]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_p_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_p_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        var _token = $("input[name=_token]").val();
        var clubId = $("input[name=clubId]").val();
        var branchId = $("input[name=branchId]").val();
        var playgroundPhotos = photosArr;
        //var c_b_banner = $("input[name=c_b_banner]").val();
        var c_b_p_desc = $('textarea#c_b_p_desc').val();

        $.ajax({
            type: 'POST',
            url: '/club/StoreRegisterClubPlayground',

            data: {
                _token: _token,
                clubId: clubId,
                branchId: branchId,
                c_b_p_name: c_b_p_name,
                c_b_p_phone: c_b_p_phone,
                c_b_p_sport_id: c_b_p_sport_id,
                c_b_p_price_per_hour: c_b_p_price_per_hour,
                c_b_p_city: c_b_p_city,
                c_b_p_area: c_b_p_area,
                c_b_p_address: c_b_p_address,
                c_b_p_desc: c_b_p_desc,
                photosArr: photosArr,
                features: features,
            },
            success: function (data) {
                console.log(data);
                //alert(data);
                swal({
                    title: "Created",
                    text: "Playground Created successfuly !!!",
                    icon: "success",
                    dangerMode: false,
                });
                //$('#clubUserName').text(data);
                $('.contentChangable').css('opacity', '1');
                $('.Loader').fadeOut();
                $('#contentChangable').load('club/registerAddBranch').fadeIn('slow');
                //$('#EventGames').load('http://127.0.0.1:8000/Event/' + MainEvent + '/Games').fadeIn('slow');

            }
        });

    } else {

        swal({
            title: "Not Valid ?",
            text: "Check Errors, and try again !!!",
            icon: "warning",
            dangerMode: true,
        });

    }

});
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// end [[ create ]] Playground record for Club before [[ register ]] /////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////
/////////// start [[ update ]] Playground record for Club [[ before register ]] ///////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#updatePlaygroundRegister", function (e) {
    e.preventDefault();

    var features = [];

    $("input[name='features[]']:checked").each(function () {
        features.push($(this).val());
    });

    var errors = 0;

    var c_b_p_name = $("input[name=c_b_p_name]").val();

    if (c_b_p_name.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_name]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_phone = $("input[name=c_b_p_phone]").val();

    if (c_b_p_phone.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_phone]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_sport_id = $("select[name=c_b_p_sport_id]").val();

    if (c_b_p_sport_id.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_b_p_sport_id]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_p_sport_id]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_price_per_hour = $("input[name=c_b_p_price_per_hour]").val();

    if (c_b_p_price_per_hour.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_price_per_hour]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_price_per_hour]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_city = $("select[name=c_b_p_city]").val();

    if (c_b_p_city.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_b_p_city]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_p_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_area = $("select[name=c_b_p_area]").val();

    if (c_b_p_area.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_b_p_area]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_p_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_p_address = $("input[name=c_b_p_address]").val();

    if (c_b_p_address.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_p_address]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_p_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    if (errors === 0) {
        $('.contentChangable').css('opacity', '0.6');
        $('.Loader').fadeIn();

        $("input[name=c_b_p_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_sport_id]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_price_per_hour]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_p_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_p_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_p_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        var _token = $("input[name=_token]").val();
        var playgroundId = $("input[name=playgroundId]").val();
        var branchId = $("input[name=branchId]").val();
        //var playgroundPhotos = photosArr ;
        //var c_b_banner = $("input[name=c_b_banner]").val();
        var c_b_p_desc = $('textarea#c_b_p_desc').val();

        $.ajax({
            type: 'POST',
            url: '/UpdateRegisterClubPlayground',

            data: {
                _token: _token,
                playgroundId: playgroundId,
                branchId: branchId,
                c_b_p_name: c_b_p_name,
                c_b_p_phone: c_b_p_phone,
                c_b_p_sport_id: c_b_p_sport_id,
                c_b_p_price_per_hour: c_b_p_price_per_hour,
                c_b_p_city: c_b_p_city,
                c_b_p_area: c_b_p_area,
                c_b_p_address: c_b_p_address,
                c_b_p_desc: c_b_p_desc,
                features: features,
            },
            success: function (data) {
                console.log(data);
                //alert(data);
                swal({
                    title: "Upated",
                    text: "Playground Upated successfuly !!!",
                    icon: "success",
                    dangerMode: false,
                });
                //$('#clubUserName').text(data);
                $('.contentChangable').css('opacity', '1');
                $('.Loader').fadeOut();
                //$('#contentChangable').load('club/registerAddBranch').fadeIn('slow');
                //$('#EventGames').load('http://127.0.0.1:8000/Event/' + MainEvent + '/Games').fadeIn('slow');

            }
        });

    } else {

        swal({
            title: "Not Valid ?",
            text: "Check Errors, and try again !!!",
            icon: "warning",
            dangerMode: true,
        });

    }

});
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// end [[ update ]] Playground record for Club before [[ register ]] /////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// start [[ Delete ]] club Playground by Playground Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".DeletePlayground", function () {
    var PlaygroundId = $(this).attr('id');
    $('#contentChangable').fadeOut('200');
    $('.Loader').fadeIn();
    var _token = $("input[name=_token]").val();
    $.ajax({
        type: 'POST',
        url: '/club/DeleteRegisterClubPlayground',

        data: {
            _token: _token,
            PlaygroundId: PlaygroundId,
        },
        success: function (data) {
            console.log(data);
            //alert(data);
            swal({
                title: "Deleted",
                text: "Playground Deleted successfuly !!!",
                icon: "success",
                dangerMode: false,
            });
            $('.Loader').delay(500).fadeOut();
            $('#contentChangable').load('/club/registerAddBranch').fadeIn('slow');
            $('#contentChangable').fadeIn('200');
        }
    });
});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// end [[ Delete ]] club Playground by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// start [[ Delete ]] club Branch by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".DeleteBranch", function () {
    var BranchId = $(this).attr('id');
    $('#contentChangable').fadeOut('200');
    $('.Loader').fadeIn();
    var _token = $("input[name=_token]").val();
    $.ajax({
        type: 'POST',
        url: '/club/DeleteRegisterClubBranch',

        data: {
            _token: _token,
            BranchId: BranchId,
        },
        success: function (data) {
            console.log(data);
            //alert(data);
            swal({
                title: "Deleted",
                text: "Branch Deleted successfuly !!!",
                icon: "success",
                dangerMode: false,
            });
            $('.Loader').delay(500).fadeOut();
            $('#contentChangable').load('/club/registerAddBranch').fadeIn('slow');
            $('#contentChangable').fadeIn('200');
        }
    });
});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// end [[ Delete ]] club Branch by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
////////// start handle [[ Edit ]] club Branch view by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#updateBranchRegister", function (e) {
    e.preventDefault();
    var errors = 0;

    var c_b_name = $("input[name=c_b_name]").val();

    if (c_b_name.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_name]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_phone = $("input[name=c_b_phone]").val();

    if (c_b_phone.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_phone]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_city = $("select[name=c_b_city]").val();

    if (c_b_city.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_b_city]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_area = $("select[name=c_b_area]").val();

    if (c_b_area.replace(/\s/g, "") === "") {

        //errors = 1;
        $("select[name=c_b_area]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_address = $("input[name=c_b_address]").val();

    if (c_b_address.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_address]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    if (errors === 0) {
        $('#contentChangable').fadeOut('200');
        $('.Loader').fadeIn();

        $("input[name=c_b_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        var _token = $("input[name=_token]").val();
        var clubBranch = $("input[name=clubBranch]").val();
        var c_b_desc = $('textarea#c_b_desc').val();

        $.ajax({
            type: 'POST',
            url: '/club/updateRegisterClubBranch',

            data: {
                _token: _token,
                clubBranch: clubBranch,
                c_b_name: c_b_name,
                c_b_phone: c_b_phone,
                c_b_city: c_b_city,
                c_b_area: c_b_area,
                c_b_address: c_b_address,
                c_b_desc: c_b_desc,
            },
            success: function (data) {
                console.log(data);
                //alert(data);
                swal({
                    title: "Updated",
                    text: "Branch Updated successfuly !!!",
                    icon: "success",
                    dangerMode: false,
                });
                $('.Loader').delay(500).fadeOut();

                $('#contentChangable').load('/club/' + clubBranch + '/DisplayEditBranchRegister').fadeIn('slow');
                $('#contentChangable').fadeIn('200');

            }
        });

    } else {

        swal({
            title: "Not Valid ?",
            text: "Check Errors, and try again !!!",
            icon: "warning",
            dangerMode: true,
        });

    }

});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////// end handle [[ Edit ]] club Branch view by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
/////////// start [[ create ]] Playground record for Club [[ before register ]] ///////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#AddNewBranchRegister", function (e) {
    e.preventDefault();
    var errors = 0;

    var c_b_name = $("input[name=c_b_name]").val();

    if (c_b_name.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_name]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_phone = $("input[name=c_b_phone]").val();

    if (c_b_phone.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_phone]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_city = $("select[name=c_b_city]").val();

    if (c_b_city.replace(/\s/g, "") === "") {

        errors = 1;
        $("select[name=c_b_city]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_area = $("select[name=c_b_area]").val();

    if (c_b_area.replace(/\s/g, "") === "") {

        // errors = 1;
        $("select[name=c_b_area]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("select[name=c_b_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var c_b_address = $("input[name=c_b_address]").val();

    if (c_b_address.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=c_b_address]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=c_b_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    if (errors === 0) {
        $('.contentChangable').css('opacity', '0.6');
        $('.Loader').fadeIn();

        $("input[name=c_b_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=c_b_phone]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_area]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_city]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("select[name=c_b_address]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        var _token = $("input[name=_token]").val();
        var clubId = $("input[name=clubId]").val();
        //var c_b_logo = $("input[name=c_b_logo]").val();
        //var c_b_banner = $("input[name=c_b_banner]").val();
        var c_b_desc = $('textarea#c_b_desc').val();

        $.ajax({
            type: 'POST',
            url: '/club/StoreRegisterClubBranch',

            data: {
                _token: _token,
                clubId: clubId,
                c_b_name: c_b_name,
                c_b_phone: c_b_phone,
                c_b_city: c_b_city,
                c_b_area: c_b_area,
                c_b_address: c_b_address,
                c_b_desc: c_b_desc,
                //c_b_logo:c_b_logo,
                //c_b_banner:c_b_banner,
            },
            success: function (data) {
                console.log(data);
                //alert(data);
                swal({
                    title: "Created",
                    text: "Branch Created successfuly !!!",
                    icon: "success",
                    dangerMode: false,
                });
                //$('#clubUserName').text(data);
                $('.contentChangable').css('opacity', '1');
                $('.Loader').fadeOut();
                $('#contentChangable').load('club/registerAddBranch').fadeIn('slow');
                //$('#EventGames').load('http://127.0.0.1:8000/Event/' + MainEvent + '/Games').fadeIn('slow');

            }
        });

    } else {

        swal({
            title: "Not Valid ?",
            text: "Check Errors, and try again !!!",
            icon: "warning",
            dangerMode: true,
        });

    }

});
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// end [[ create ]] Playground record for Club [[ before register ]] /////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// start display [[ Add ]] Playground view by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".AddPlaygroundRegister", function () {
    var BranchId = $(this).attr('id');
    $('#contentChangable').fadeOut('200');
    $('.Loader').fadeIn();


    $('.Loader').delay(500).fadeOut();

    $('#contentChangable').load('/club/' + BranchId + '/DisplayAddPlaygroundRegister').fadeIn('slow');
    $('#contentChangable').fadeIn('200');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// end display [[ Add ]] Playground view by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// start display [[ Edit ]] Playground view by Playground Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".DisplayEditPlayground", function () {
    var PlaygroundId = $(this).attr('id');
    $('#contentChangable').fadeOut('200');
    $('.Loader').fadeIn();


    $('.Loader').delay(500).fadeOut();

    $('#contentChangable').load('/club/' + PlaygroundId + '/DisplayEditPlaygroundRegister').fadeIn('slow');
    $('#contentChangable').fadeIn('200');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// end display [[ Edit ]] Playground view by Playground Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// start display [[ Edit ]] club Branch view by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".DisplayEditBranch", function () {
    var BranchId = $(this).attr('id');
    $('#contentChangable').fadeOut('200');
    $('.Loader').fadeIn();


    $('.Loader').delay(500).fadeOut();

    $('#contentChangable').load('/club/' + BranchId + '/DisplayEditBranchRegister').fadeIn('slow');
    $('#contentChangable').fadeIn('200');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// end display [[ Edit ]] club Branch view by Branch Id [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// start [[ display ]] club profile Edit Part [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#ShowEditPart", function () {
    //alert('done') ;
    $('#contentChangable').fadeOut('200');
    $('.Loader').fadeIn();


    $('.Loader').delay(500).fadeOut();

    $('#contentChangable').load('/club/editMainRegisterInfo/ebr').fadeIn('slow');
    $('#contentChangable').fadeIn('200');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// end [[ display ]] club profile Edit Part [[ before register]]/////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
//// start [[ display ]] club Manage [[ add edit branches && courts ]] Part [[ before register]]///
///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".ShowManagePart", function () {
    alert('done') ;
    $('#contentChangable').fadeOut('200');
    $('.Loader').fadeIn();


    $('.Loader').delay(500).fadeOut();

    $('#contentChangable').load('/club/registerAddBranch/ebr').fadeIn('slow');
    $('#contentChangable').fadeIn('200');
});

///////////////////////////////////////////////////////////////////////////////////////////////////
//// end [[ display ]] club Manage [[ add edit branches && courts ]] Part [[ before register]]/////
///////////////////////////////////////////////////////////////////////////////////////////////////

































