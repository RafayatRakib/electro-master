
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Step Progress Bar</title>

    <!-- UniIcon CDN Link  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<style>


ul{
    display: flex;
    margin-top: 80px;
}
ul li{
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}
ul li .icon{
    font-size: 35px;
    color: #ff4732;
    margin: 0 60px;
}
ul li .text{
    font-size: 14px;
    font-weight: 600;
    color: #ff4732;
}

/* Progress Div Css  */

ul li .progress{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(68, 68, 68, 0.781);
    margin: 14px 0;
    display: grid;
    place-items: center;
    color: #fff;
    position: relative;
    cursor: pointer;
}
.progress::after{
    content: " ";
    position: absolute;
    width: 125px;
    height: 5px;
    background-color: rgba(68, 68, 68, 0.781);
    left: 30px;
}
.one::after{
    width: 0;
    height: 0;
}
ul li .progress .uil{
    display: none;
}
ul li .progress p{
    font-size: 13px;
}

/* Active Css  */

ul li .active{
    background-color: #ff4732;
    display: grid;
    place-items: center;
}
li .active::after{
    background-color: #ff4732;
}
ul li .active p{
    display: none;
}
ul li .active .uil{
    font-size: 20px;
    display: flex;
}

/* Responsive Css  */

@media (max-width: 980px) {
    ul{
        flex-direction: column;
    }
    ul li{
        flex-direction: row;
    }
    ul li .progress{
        margin: 0 30px;
    }
    .progress::after{
        width: 5px;
        height: 55px;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
    }
    .one::after{
        height: 0;
    }
    ul li .icon{
        margin: 15px 0;
    }
}

@media (max-width:600px) {
    .head .head_1{
        font-size: 24px;
    }
    .head .head_2{
        font-size: 16px;
    }
}



    </style>
</head>
<body>
    <div class="">


        <ul>
            <li>
                <i class="icon uil uil-capture"></i>
                <div class="progress five ">
                    <p>1</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Add To Cart</p>
            </li>
            <li>
                <i class="icon uil uil-clipboard-notes"></i>
                <div class="progress four">
                    <p>2</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Fill Details</p>
            </li>
            <li>
                <i class="icon uil uil-credit-card"></i>
                <div class="progress three active">
                    <p>3</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Make Payment</p>
            </li>
            <li>
                <i class="icon uil uil-exchange"></i>
                <div class="progress two active">
                    <p>4</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Order in Progress</p>
            </li>
            <li>
                <i class="icon uil uil-map-marker"></i>
                <div class="progress one active">
                    <p>5</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Order Arrived</p>
            </li>
        </ul>

    </div>

</body>
</html>


<!-- 
<script>
    


const one = document.querySelector(".one");
const two = document.querySelector(".two");
const three = document.querySelector(".three");
const four = document.querySelector(".four");
const five = document.querySelector(".five");

one.onclick = function() {
    one.classList.add("active");
    two.classList.remove("active");
    three.classList.remove("active");
    four.classList.remove("active");
    five.classList.remove("active");
}

two.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.remove("active");
    four.classList.remove("active");
    five.classList.remove("active");
}
three.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.remove("active");
    five.classList.remove("active");
}
four.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.add("active");
    five.classList.remove("active");
}
five.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.add("active");
    five.classList.add("active");
}

</script> -->