

<div class="site-index">

    <div class="jumbotron">


        <div class="container">

            <ul id="exampleSlider" style="list-style-type:none">
                <li><img src="http://goo.gl/oGUaIQ" alt="" /></li>
                <li><img src="http://goo.gl/8494zr" alt="" /></li>
                <li><img src="http://goo.gl/hmAsB9" alt="" /></li>
                <li><img src="http://goo.gl/wkgVSH" alt="" /></li>
                <li><img src="http://goo.gl/eq3qhS" alt="" /></li>
                <li><img src="https://goo.gl/Jva4sA" alt="" /></li>


            </ul>

        </div>

    </div>  
</div>

<script type="text/javascript">

    $(function () {

        /* SET PARAMETERS */
        var change_img_time = 5000;
        var transition_speed = 300;

        var simple_slideshow = $("#exampleSlider"),
                listItems = simple_slideshow.children('li'),
                listLen = listItems.length,
                i = 0,
                changeList = function () {

                    listItems.eq(i).fadeOut(transition_speed, function () {
                        i += 1;
                        if (i === listLen) {
                            i = 0;
                        }
                        listItems.eq(i).fadeIn(transition_speed);
                    });

                };

        listItems.not(':first').hide();
        setInterval(changeList, change_img_time);

    });

</script>