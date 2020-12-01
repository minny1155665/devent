$(document).ready(function(){

    var w =$(window).width();
    var rightw=w*0.6;

    if(w<=750){
        rightw = w;
    };

    $(".banner img").css({
        "width": +rightw+"px"
    })
    var num_li = $(".nav li").length;
    var img_width = rightw;
    var width_banner = num_li*img_width;
    var timer = 3000; //  設定輪撥速度
    $(".banner").css("width", width_banner);

    $(window).resize(function(){
        w =$(window).width();
        rightw=w*0.6;

        if(w<=750){
            rightw = w;
        };

        $(".banner img").css({
            "width": +rightw+"px"
        })
        num_li = $(".nav li").length;
        img_width = rightw;
        width_banner = num_li*img_width;
        $(".banner").css("width", width_banner);
    });

    //  當滑鼠移過時，圖片移動到特定位置
    for (i = 0; i < num_li; i++) {
        $(".nav li:eq(" + i + ")").mouseenter({
            id: i
        }, function(e) {
            n = e.data.id
            change();
        })
    }

    //  設定輪撥函數
    clock = setInterval(auto, timer);
    n = 0;

    function auto() {
        n++;
        if (n >= num_li) {
            n = 0;
        }
        position = -n * img_width;
        $(".banner").animate({
            "left": +position + "px"
        }, 400)

        $(".nav li").css({

            "color": "#d8d8d8",
            "border-bottom": "none"
        })
            //  讓滑鼠移到的清單改變成 hover 字體
        $(".nav li:eq(" + n + ")").css({
            "color": "#555555",
            "border-bottom": "3px solid #555555",
            "border-radius": "3px"
        })
    }

    //  當滑鼠移到圖案上時輪撥暫停
    $(".banner img").hover(function() {
        clearInterval(clock)
    }, function() {
        clock = setInterval(auto, timer)
    })

    //  當滑鼠移到 nav 時，根據標題移動圖片
    function change() {
        clearInterval(clock);
        clock = setInterval(auto, timer);
        position2 = -n * img_width;
        $(".banner").stop();
        $(".banner").animate({
                "left": +position2 + "px"
        }, 400)
            //  讓所有的清單變回原本的字體
        $(".nav li").css({

                "color": "#d8d8d8",
                "border-bottom": "none"
        })
            //  讓滑鼠移到的清單改變成 hover 字體
        $(".nav li:eq(" + n + ")").css({
            "color": "#555555",
            "border-bottom": "3px solid #555555",
            "border-radius": "3px"
        })
    }
    
});

