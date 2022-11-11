<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <title>Trend Trái Tim- HMC</title>
    <style>
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-size: 16px;
      }
      body {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #333;
      }
      .container {
        width: 400px;
        height: 500px;
        background: linear-gradient(35deg, #e84393, #6c5ce7);
        border-radius: 20px;
        box-shadow: #fff 0px 2px 1px, #fff 0px 4px 2px, #fff 0px 8px 4px,
          #fff 0px 6px 8px, #6c5ce7 0px 8px 16px;
        position: relative;
      }
      h3 {
        text-align: center;
        margin: 40px 0;
        font-size: 150%;
        color: #fff;
        text-shadow: 1px 1px 2px red, 0 0 1em green, 0 0 0.2em green;
      }
      .box {
        width: 80%;
        margin: 0 auto;
      }

      .header {
        text-align: center;
        margin: 20px auto;
      }

      .header label {
        font-size: 150%;
        color: #fff;
        text-shadow: #fc0 1px 0 10px;
      }
      .header input {
        margin-top: 10px;
        padding: 10px;
        border-radius: 10px;
        width: 100%;
      }
      .footer {
        width: 80%;
        background-color: white;
        height: 20%;
        position: absolute;
        bottom: 50px;
        display: flex;
        border-radius: 8px;
      }

      input {
        outline: none;
      }
      .content input {
        padding: 15px 20px;
        background-color: blue;
        border-radius: 8px;
        color: #fff;
        width: 50%;
        border: none;
      }

      .bi {
        font-size: 220%;
        padding: 5px;
        border-radius: 5px;
      }

      .bi-facebook {
        color: #0984e3;
      }

      .tiktok {
        color: #fff;
        width: 70px;
      }

      .hover:hover {
        transform: scale(1.1);
        transition: 0.5s;
      }
      a:hover {
        color: red;
        opacity: 0.9;
      }

      .btn-hover {
        width: 200px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
        /* margin: 20px; */
        height: 50px;
        text-align: center;
        border: none;
        background-size: 300% 100%;

        border-radius: 50px;
        transition: all 0.4s ease-in-out;
      }

      .btn-hover:hover {
        background-position: 100% 0;
        transition: all 0.4s ease-in-out;
      }

      .btn-hover.color-2 {
        background-image: linear-gradient(
          to right,
          #f5ce62,
          #e43603,
          #fa7199,
          #e85a19
        );
        box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
      }

      .copy {
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h3>TREND TRÁI TIM - HMC</h3>
      <div class="box">
        <form id="oForm" method="POST" action="heart.php">
          <div class="header">
            <label>Tên của bạn </label
            ><input
              type="text"
              id="name"
              name="name"
              placeholder="Enter your name"
              required=""
            />
          </div>
          <div class="content">
            <div style="text-align: right">
              <input
                class="btn-hover color-2"
                type="submit"
                value="Nhập"
                onclick="heart()"
                name="btn-nhap"
              />
            </div>

            <div style="font-size: 150%; color: #fff; margin: 20px 0">
              Lấy code
              <a href="https://www.facebook.com/cong200x" target="_blank"
                >tại đây</a
              >
            </div>
          </div>
        </form>
        <div class="footer">
          <div
            style="
              position: absolute;
              top: -12px;
              left: 10px;
              font-size: 120%;
              color: #333;
              background-color: transparent;
            "
          >
            Contact:
          </div>
          <div
            style="display: flex; justify-content: center; align-items: center"
          >
            <div class="hover">
              <a href="https://www.facebook.com/cong200x" target="_blank"
                ><i class="bi bi-facebook"></i
              ></a>
            </div>
            <div class="hover">
              <a href="https://www.tiktok.com/@hmc0215" target="_blank"
                ><img
                  class="bi tiktok"
                  src="https://logowik.com/content/uploads/images/tiktok-logo-black.jpg"
                  alt="logo"
              /></a>
            </div>
          </div>
        </div>
        <div class="copy">Copyright &copy; HMC</div>
      </div>
    </div>

    <script>
      // function heart() {
      //   var name = document.getElementById("name");
      //   if (name.value === "") {
      //     alert("Bạn chưa nhập tên!!!");
      //     return;
      //   }
      //   var aForm;
      //   aForm = oForm.elements;
      //   var myObject = new Object();
      //   myObject.name = aForm.name;

      //   window.FormData.name = myObject.name;
      //   window.location.href = "heart.html";
      // }
    </script>
  </body>
</html>
