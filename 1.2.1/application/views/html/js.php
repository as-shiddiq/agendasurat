    <script src="<?php echo base_url('assets/js/jquery-2.1.1.js')?>"></script>

    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui-1.9.2.custom.min.js')?>"></script>

   <script src="<?php echo base_url('assets/js/jquery.prettyPhoto.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.isotope.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/main.js')?>"></script>
    <script src="<?php echo base_url('assets/js/wow.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.newsTicker.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.li-scroller.1.0.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.flexslider-min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/theme20.js')?>"></script>


    <script src="<?php echo base_url('assets/js/jquery.validate.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js')?>"></script>
    <script src="<?php echo base_url('assets/js/moment.min.js')?>"></script>

    <script src="<?php echo base_url('assets/daterangepicker/daterangepicker.js')?>"></script>

    <script src="<?php echo base_url('assets/js/chosen.jquery.min.js')?>"></script>
    <!-- Data Tables -->
    <script src="<?php echo base_url('assets/js/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('assets/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/js/dataTables.responsive.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.nicescroll.js')?>"></script>



    <script type="text/javascript">

        $(document).ready(function() {
            $('#table').DataTable({
                "sPaginationType": "full_numbers",
                "sPageButton": "paginate_button",
                "sPageButtonActive": "paginate_active",
                "sPageFirst": "awal",
                "sPagePrevious": "sebelumnya",
                "sPageNext": "selanjutnya",
                "sPageLast": "akhir",
                "bInfo": true,
                "bAutoWidth": false,
                "aLengthMenu":[10,15,20,30,50,100],
                "bStateSave": true,
                "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_ Data",
                    "sZeroRecords": "Maaf data tidak ditemukan",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(Disaring dari _MAX_ total data)",
                    "sSearch": "Cari:",
                },
                responsive: true
            });
    });
     </script>

     <script type="text/javascript">

   $(document).ready(function(){
      $('select').chosen({
         disable_search_threshold: 10
      });

      $(".validate").validate();

  })

    $(function() {
                $( ".daterangepicker" ).daterangepicker({
                  format: 'DD-MM-YYYY',
                  separator :' s/d ',
                  locale :{
                      applyLabel: 'Terapkan',
                      fromLabel: 'Mulai',
                      toLabel: 'Sampai',
                  },
                  });
                $( ".datepicker" ).datepicker({ format: 'dd-mm-yyyy' });

            });
    function getkey(e) {
        if (window.event) return window.event.keyCode;
        else if (e) return e.which;
        else return null;
    }
    function goodchars(e, goods, field){
    var key, keychar;
    key = getkey(e);
    if (key == null) return true;

    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    goods = goods.toLowerCase();

    // check goodkeys
    if (goods.indexOf(keychar) != -1)
        return true;
    // control keys
    if ( key==null || key==0 || key==8 || key==9 || key==27 )
       return true;

    if (key == 13) {
        var i;
        for (i = 0; i < field.form.elements.length; i++)
            if (field == field.form.elements[i])
                break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
        };
    // else return false
    return false;
    }
         $(document).ready(function(){
            $('#myCarousel').carousel({interval: 5000});
            $("ul#news").liScroll({travelocity: 0.04});

        /*$('#agenda a').click(function (e) {
           e.preventDefault();
          $(this).tab('show');
        })
        $('#content-art a,#content-art2 a ').click(function (e) {
           e.preventDefault();
          $(this).tab('show');
        })*/
        $('.newsTicker').newsTicker({
            row_height: 80,
            max_rows: 4,
            duration: 4000
        });
        $('.newsTicker2').newsTicker({
            row_height: 80,
            max_rows: 3,
            duration: 4100,
            prevButton: $('.newsTicker2-prev'),
            nextButton: $('.newsTicker2-next')
        });
        $('.newsTicker3').newsTicker({
            row_height: 80,
            max_rows: 3,
            duration: 4300,
            prevButton: $('.newsTicker3-prev'),
            nextButton: $('.newsTicker3-next')
        });
        jQuery(".magazine-carousel").jCarouselLite({

            btnNext: ".magazine-carousel .nexte",

            btnPrev: ".magazine-carousel .preve",

            easing: "easeInOutBack",

            scroll: 1,

            hoverPause: true,

            auto: 3000,

            speed: 700,

          });
        $("a[data-gal^='lightbox']").prettyPhoto({

            animation_speed: 'normal',

            theme: 'pp_default',

            autoplay_slideshow: false,

            overlay_gallery: false,

            show_title: false

          });
       $(".data-balitbang").niceScroll({styler:"fb",cursorcolor:"#444", cursorwidth: '5', cursorborderradius: '10px', background: '#aaa', spacebarenabled:false, cursorborder: ''});
       $("html").niceScroll({styler:"fb",cursorcolor:"#dd0", cursorwidth: '5', cursorborderradius: '10px', background: '#333', spacebarenabled:false, cursorborder: ''});

    })

    </script>
    <script type="text/javascript">
    $(function() {

    $('#plus-ex').click(function(){
    if($(this).hasClass('plus')){
    $(this).removeClass('plus')
    $(this).addClass('ex');
    $('#moment-buttons li').addClass('out');
    $('#moment-buttons').addClass('out');
    } else {
    $(this).removeClass('ex');
    $(this).addClass('plus');
    $('#moment-buttons li').removeClass('out');
    $('#moment-buttons').removeClass('out');
    }
    return false;
    });
    });

    <?php
        if(aktif_lockscreen()=='Y'){ 
    ?>
            var $lockscreen=localStorage.getItem('lockscreen');
            var $timelock=0;
            var animateIn='animated flipInY';
            var animateOut='animated bounceOutUp';
            var $lama_waktu_lockscreen=<?=lama_waktu_lockscreen()*6000?>;
            lockscreen($lockscreen);
            $(function(){
                if($lockscreen!="true"){
                    checklock($timelock,$lama_waktu_lockscreen,2000,true);
                }
                
            });
            function checklock($a,$b,$c,$d){
                if($d==true){
                    setTimeout(function() {
                        console.log($a);
                        $timelock+=parseInt($c);
                        if($timelock>=$lama_waktu_lockscreen){
                            $(document).ready(function(){
                                localStorage.setItem('lockscreen',true);
                                lockscreen("true");
                                $timelock=0;
                                checklock($timelock,$b,$c,false);
                            })

                           //window.location="<?=site_url("lockscreen")?>";
                        }
                        else{
                            checklock($timelock,$b,$c,$d);
                        }
                     },$c);
                }
            }

            function lockscreen(lock){
                if(lock=="true"){
                    parent.checklock($timelock,$lama_waktu_lockscreen,2000,false);
                    $(document).ready(function(){
                        $(".container.page").fadeOut();
                        $(".lockscreen").slideDown("slow");
                        $(".form-login").removeClass(animateOut);
                        setTimeout(function() {
                            $(".form-login").addClass(animateIn).removeAttr("style");
                         },800);

                    })
                }
            }
            function openlock($password){
                if($password.length>=4){
                    $.ajax({
                      url:"<?=site_url('login/lockscreen')?>",
                      data:"password="+$password,
                      type:"POST",
                      success:function(data){
                        if(data.trim()=='sukses'){
                            lockscreen(false);
                            $(".container.page").fadeIn();
                            localStorage.setItem('lockscreen',false);
                            $timelock=0;
                            parent.checklock($timelock,$lama_waktu_lockscreen,2000,true);
                            $(".form-login").removeClass(animateIn);
                            $(".form-login").addClass(animateOut);
                            setTimeout(function() {
                                 $(".lockscreen").slideUp("slow");
                                $(".form-login").attr({"style":"display:none"});

                            },1000);
                            
                        }
                      }
                    })
                }
            }
            $(document).ready(function(){
                $("[name=buka]").click(function(){
                    $password=$("[name=password_lock]").val();
                    openlock($password);
                })
                $("[name=password_lock]").keyup(function(){
                    $password=$("[name=password_lock]").val();
                    openlock($password);  
                })
            })
    <?php } ?>
    </script>
