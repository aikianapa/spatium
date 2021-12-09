<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Yonger">
    <meta name="author" content="{{_sett.header}}">
    <link rel="shortcut icon" type="image/svg+xml" href="/tpl/assets/img/favicon.svg">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <title>{{header}}</title>
    <link rel="stylesheet" href="{{_var.assets}}/css/dashforge.css">
</head>
<script type="wbapp">
        wbapp.loadScripts([
            "/engine/lib/bootstrap/js/bootstrap.bundle.min.js"
        ]);
        wbapp.sign = {
            checkphone: function(type = 'reg') {
                if (!$('#form').verify()) return;
                let $phone = $('#form input[name=phone]');
                let phone = $phone.val();
                if (type == 'reg') $phone.removeClass('is-invalid').attr('readonly',true);
                let form = wbapp.objByForm('#form form');
                form.type = type;
                wbapp.post('/module/phonecheck/getcode/',form,function(data){
                    if (data.error) {
                        $('#form .tx-danger').html(data.msg).removeClass('d-none');
                    } else {
                        $('#form [name=code]').val(data.code);
                        $('#form .tx-danger').addClass('d-none');
                        $('#form phone').text(phone);
                        $('#form .btn-primary').addClass('d-none');
                        $('#form .after-send-code').removeClass('d-none');
                        var wait = 3;
                        var timer = setInterval(function(){
                            wait--;
                            $('#form .wait').text(wait);    
                        },1000);
                        $('#form .wait').text(wait);
                        setTimeout(function(){
                            $('#form .btn-repeat').removeClass('d-none');
                            $('#form .msg-repeat').addClass('d-none');
                            clearInterval(timer);
                        }, (wait*1000));
                    }
                })
                $('#form .btn-repeat').off('tap click');
                $('#form .btn-repeat').on('tap click',function(){
                    let type = 'reg';
                    $('#form .btn-repeat').addClass('d-none');
                    $('#form .msg-repeat').removeClass('d-none');
                    $('#form .btn-repeat').hasClass('login') ? type = 'login' : null ;
                    wbapp.sign.checkphone(type);
                });
            },
            reg: function() {
                    wbapp.post('/module/phonecheck/reg/',{
                        'check':$('#form [name=code]').val()
                    },function(data){
                        if (data.error) {
                            $('#form .after-send-code').addClass('is-invalid');
                            $('#form .tx-danger').text(data.msg).removeClass('d-none');
                        } else {
                            $('#form .tx-danger').addClass('d-none');
                            $('#form .after-send-code').addClass('d-none');
                            $('#form .after-reg').removeClass('d-none');
                            $('#form .tx-success').text(data.msg).removeClass('d-none');
                        }
                    });
            },
            login: function() {
                wbapp.post('/module/phonecheck/login/',{
                        'phone':$('#form [name=phone]').val(),
                        'check':$('#form [name=code]').val()
                    },function(data){
                        if (data.login == true && data.error == false) {
                            document.location.href = data.user.group.url_login;
                        } else {
                            $('#form .tx-danger').html(data.msg).removeClass('d-none');
                        }
                    });
            }
        };
        $(document).on('wb-verify-false',function(e,input){
            $(input).addClass('is-invalid').removeClass('is-valid');
        })

        $(document).on('wb-verify-true',function(e,input){
            $(input).addClass('is-valid').removeClass('is-invalid');
        })
    </script>

<style wb-module="scss">
#signup {
    font-family: sans;
    width: 100vw;
    overflow: hidden;
    .overflow-y {
        overflow-y: auto;
    }
    
    .btn-rounded {
        border-radius: 100px;
    }

    #image {
        background: url(/modules/yonger/tpl/assets/img/signup_bg.jpg) 50% 0%;
        background-size: cover;
        height: 100vh;

        .d-flex {
            height: 100vh;
            align-items: center;
            background: #161C2799;
        }

        h1 {
            margin-top: 15vh;
            font-style: normal;
            font-weight: bold;
            font-size: 48px;
            line-height: 58px;
            color: #FFFFFF;
            width: 70%;
        }

        p {
            width: 70%;
            font-weight: 500;
            font-size: 18px;
            line-height: 26px;
            letter-spacing: 0.1px;
            color: white;
        }

        .btn {
            position: absolute;
            bottom: 5vh;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 24px 53px;
            width: 207px;
            height: 60px;
        }
    }

    #form {
        align-items: center;
        h2 {
            font-size: 30px;
            font-style: normal;
            font-weight: 700;
            line-height: 36px;
            letter-spacing: -0.4px;
            text-align: left;
            color: #171717;
        }
        label {
            font-family: Roboto;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            letter-spacing: 0.1px;
            text-align: left;
            color: #50B5FF;
            &.is-invalid {
                color: var(--danger);
            }
        }
        .form-control {
            font-family: Roboto;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 19px;
            letter-spacing: 0.1px;
            text-align: left;
            border: 0;
            border-radius: 0;
            border-bottom: 1px #50B5FF solid;
            background: transparent;
            &.is-invalid {
                border-bottom: 1px var(--danger) solid;
            }
        }
        .d-flex {
            height: 80vh;
            align-items: center;
        }
    }
}
</style>