<!-- EDIT BY Hoàng Minh Công
    fb: https://www.facebook.com/cong200x
-->

<?php
$name ='';
    if(isset($_POST['btn-nhap'])){
      $name = $_POST['name'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <style>
    html,
    body {
        height: 100%;
        padding: 0;
        margin: 0;
        background: rgba(0, 0, 0, 0.851);
        overflow: hidden;
        position: relative;
    }

    canvas {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    #pinkboard {
        animation: animate 1s infinite;
    }

    .text {
        min-height: 100vh;
        width: 100%;
        position: relative;
        color: white;
        text-shadow: 1px 1px 2px red, 0 0 1em white, 0 0 0.2em white;
        font-size: 180%;
        /* animation: animate 1s infinite; */
    }

    @keyframes animate {
        0% {
            transform: scale(0.85, 0.85);
        }

        20% {
            transform: scale(0.85, 0.85);
        }

        40% {
            transform: scale(0.9, 0.9);
        }

        60% {
            transform: scale(0.85, 0.85);
        }

        80% {
            transform: scale(0.9, 0.9);
        }

        100% {
            transform: scale(0.85, 0.85);
        }
    }

    .text span {
        position: absolute;
        transform: translate(-50%, -50%);
        visibility: hidden;
    }

    .text1 {
        min-height: 100vh;
        width: 100%;
        position: absolute;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        text-shadow: 1px 1px 2px red, 0 0 1.4em white, 0 0 0.2em white;
        font-size: 150%;
        animation: animate 1s infinite;
        z-index: 1111;
    }
    </style>

    <script>
    var oMyObject = window.FormData.name;
    console.log(oMyObject);
    </script>
</head>

<body>
    <div class="box">
        <canvas id="pinkboard"></canvas>
        <canvas id="pinkboardd"></canvas>
        <div class="text">
            <!-- <span>H</span><span>O</span><span>À</span><span>N</span><span>G</span><span>&nbsp</span><span>M</span><span>I</span><span>N</span><span>H</span><span>&nbsp</span><span>C</span><span>Ô</span><span>N</span><span>G</span> -->
            <?php
            for($i = 0; $i< strlen($name) ; $i++){
              echo '<span>'. $name[$i].'</span>';
            }
          ?>
        </div>
        <div class="text1"></div>
    </div>

    <script>
    var settings = {
        particles: {
            length: 5000, // maximum amount of particles
            duration: 4, // particle duration in sec
            velocity: 80, // particle velocity in pixels/sec
            effect: -0.55, // play with this for a nice effect
            size: 10, // particle size in pixels
            alpha: 1,
        },
    };

    /*
     */
    (function() {
        var b = 0;
        var c = ["ms", "moz", "webkit", "o"];
        for (var a = 0; a < c.length && !window.requestAnimationFrame; ++a) {
            window.requestAnimationFrame = window[c[a] + "RequestAnimationFrame"];
            window.cancelAnimationFrame =
                window[c[a] + "CancelAnimationFrame"] ||
                window[c[a] + "CancelRequestAnimationFrame"];
        }
        if (!window.requestAnimationFrame) {
            window.requestAnimationFrame = function(h, e) {
                var d = new Date().getTime();
                var f = Math.max(0, 16 - (d - b));
                var g = window.setTimeout(function() {
                    h(d + f);
                }, f);
                b = d + f;
                return g;
            };
        }
        if (!window.cancelAnimationFrame) {
            window.cancelAnimationFrame = function(d) {
                clearTimeout(d);
            };
        }
    })();
    /*
     * Point class
     */
    var Point = (function() {
        function Point(x, y) {
            this.x = typeof x !== "undefined" ? x : 0;
            this.y = typeof y !== "undefined" ? y : 0;
        }
        Point.prototype.clone = function() {
            return new Point(this.x, this.y);
        };
        Point.prototype.length = function(length) {
            if (typeof length == "undefined")
                return Math.sqrt(this.x * this.x + this.y * this.y);
            this.normalize();
            this.x *= length;
            this.y *= length;
            return this;
        };
        Point.prototype.normalize = function() {
            var length = this.length();
            this.x /= length;
            this.y /= length;
            return this;
        };
        return Point;
    })();

    /*
     * Particle class
     */
    var Particle = (function() {
        function Particle() {
            this.position = new Point();
            this.velocity = new Point();
            this.acceleration = new Point();
            this.alpha = new Point();
            this.age = 0;
        }
        Particle.prototype.initialize = function(x, y, dx, dy) {
            this.position.x = x;
            this.position.y = y;
            this.velocity.x = dx;
            this.velocity.y = dy;
            this.acceleration.x = dx * settings.particles.effect;
            this.acceleration.y = dy * settings.particles.effect;
            this.age = 0;
        };
        Particle.prototype.update = function(deltaTime) {
            this.position.x += this.velocity.x * deltaTime;
            this.position.y += this.velocity.y * deltaTime;
            this.velocity.x += this.acceleration.x * deltaTime;
            this.velocity.y += this.acceleration.y * deltaTime;
            this.age += deltaTime;
        };
        Particle.prototype.draw = function(context, image) {
            function ease(t) {
                return --t * t * t + 1;
            }
            var size = image.width * ease(this.age / settings.particles.duration);
            context.globalAlpha = 1 - this.age / settings.particles.duration;

            context.drawImage(
                image,
                this.position.x - size / 2,
                this.position.y - size / 2,
                size,
                size
            );
        };
        return Particle;
    })();
    /*
     * ParticlePool class
     */
    var ParticlePool = (function() {
        var particles,
            firstActive = 0,
            firstFree = 0,
            duration = settings.particles.duration;

        function ParticlePool(length) {
            // create and populate particle pool
            particles = new Array(length);
            for (var i = 0; i < particles.length; i++)
                particles[i] = new Particle();
        }
        ParticlePool.prototype.add = function(x, y, dx, dy) {
            particles[firstFree].initialize(x, y, dx, dy);

            // handle circular queue
            firstFree++;
            if (firstFree == particles.length) firstFree = 0;
            if (firstActive == firstFree) firstActive++;
            if (firstActive == particles.length) firstActive = 0;
        };
        ParticlePool.prototype.update = function(deltaTime) {
            var i;

            // update active particles
            if (firstActive < firstFree) {
                for (i = firstActive; i < firstFree; i++)
                    particles[i].update(deltaTime);
            }
            if (firstFree < firstActive) {
                for (i = firstActive; i < particles.length; i++)
                    particles[i].update(deltaTime);
                for (i = 0; i < firstFree; i++) particles[i].update(deltaTime);
            }

            // remove inactive particles
            while (
                particles[firstActive].age >= duration &&
                firstActive != firstFree
            ) {
                firstActive++;
                if (firstActive == particles.length) firstActive = 0;
            }
        };
        ParticlePool.prototype.draw = function(context, image) {
            // draw active particles
            if (firstActive < firstFree) {
                for (i = firstActive; i < firstFree; i++)
                    particles[i].draw(context, image);
            }
            if (firstFree < firstActive) {
                for (i = firstActive; i < particles.length; i++)
                    particles[i].draw(context, image);
                for (i = 0; i < firstFree; i++) particles[i].draw(context, image);
            }
        };
        return ParticlePool;
    })();
    /*
     * Putting it all together
     */
    (function(canvas) {
        var context = canvas.getContext("2d"),
            particles = new ParticlePool(settings.particles.length),
            particleRate =
            settings.particles.length / settings.particles.duration, // particles/sec
            time;

        // get point on heart with -PI <= t <= PI
        function pointOnHeart(t) {
            return new Point(
                160 * Math.pow(Math.sin(t), 3),
                130 * Math.cos(t) -
                50 * Math.cos(2 * t) -
                20 * Math.cos(3 * t) -
                10 * Math.cos(4 * t) +
                25
            );
        }

        // creating the particle image using a dummy canvas

        var image = (function() {
            var canvas = document.createElement("canvas"),
                context = canvas.getContext("2d");
            canvas.width = settings.particles.size;
            canvas.height = settings.particles.size;
            // helper function to create the path
            function to(t) {
                var point = pointOnHeart(t);
                point.x =
                    settings.particles.size / 2 +
                    (point.x * settings.particles.size) / 350;
                point.y =
                    settings.particles.size / 2 -
                    (point.y * settings.particles.size) / 350;
                return point;
            }
            // create the path
            context.beginPath();
            var t = -Math.PI;
            var point = to(t);
            var color = ["#f20000", "#fff"];
            while (t < Math.PI) {
                t += 0.01; // baby steps!
                point = to(t);
                w = Math.floor(Math.random() * (2.0 - -5.0)) + -5.0;
                context.fillRect(
                    point.x,
                    point.y,
                    canvas.width + w,
                    canvas.height + w
                );
                context.fillStyle = "red";
                // context.fillStyle = color[Math.floor(Math.random() * 2)];
            }

            context.closePath();
            // create the fill

            context.fill();
            // create the image
            var image = new Image();
            image.src = canvas.toDataURL();
            return image;
        })();
        // render that thing!
        function render() {
            // next animation frame
            requestAnimationFrame(render);

            // update time
            var newTime = new Date().getTime() / 1000,
                deltaTime = newTime - (time || newTime);
            time = newTime;

            // clear canvas
            context.clearRect(0, 0, canvas.width, canvas.height);

            // create new particles
            var amount = particleRate * deltaTime;
            for (var i = 0; i < amount; i++) {
                var pos = pointOnHeart(Math.PI - 2 * Math.PI * Math.random());
                var dir = pos.clone().length(settings.particles.velocity);
                particles.add(
                    canvas.width / 2 + pos.x,
                    canvas.height / 2 - pos.y,
                    dir.x,
                    -dir.y
                );
            }

            // update and draw particles
            particles.update(deltaTime);

            particles.draw(context, image);
        }

        // handle (re-)sizing of the canvas
        function onResize() {
            canvas.width = canvas.clientWidth;
            canvas.height = canvas.clientHeight;
        }
        window.onresize = onResize;

        // delay rendering bootstrap
        setTimeout(function() {
            onResize();
            render();
        }, 10);
    })(document.getElementById("pinkboard"));
    </script>

    <script>
    var settings1 = {
        particles: {
            length: 500, // maximum amount of particles

            duration: 2, // particle duration in sec

            velocity: 120, // particle velocity in pixels/sec

            effect: -0.75, // play with this for a nice effect

            size: 30, // particle size in pixels
        },
    };

    /*
    
    * RequestAnimationFrame polyfill by Erik Möller
    
    */

    // (function () {
    //   var b = 0;
    //   var c = ["ms", "moz", "webkit", "o"];
    //   for (var a = 0; a < c.length && !window.requestAnimationFrame; ++a) {
    //     window.requestAnimationFrame = window[c[a] + "RequestAnimationFrame"];
    //     window.cancelAnimationFrame =
    //       window[c[a] + "CancelAnimationFrame"] ||
    //       window[c[a] + "CancelRequestAnimationFrame"];
    //   }
    //   if (!window.requestAnimationFrame) {
    //     window.requestAnimationFrame = function (h, e) {
    //       var d = new Date().getTime();
    //       var f = Math.max(0, 16 - (d - b));
    //       var g = window.setTimeout(function () {
    //         h(d + f);
    //       }, f);
    //       b = d + f;
    //       return g;
    //     };
    //   }
    //   if (!window.cancelAnimationFrame) {
    //     window.cancelAnimationFrame = function (d) {
    //       clearTimeout(d);
    //     };
    //   }
    // })();

    /*
    
    * Point class
    
    */

    var Point = (function() {
        function Point(x, y) {
            this.x = typeof x !== "undefined" ? x : 0;

            this.y = typeof y !== "undefined" ? y : 0;
        }

        Point.prototype.clone = function() {
            return new Point(this.x, this.y);
        };

        Point.prototype.length = function(length) {
            if (typeof length == "undefined")
                return Math.sqrt(this.x * this.x + this.y * this.y);

            this.normalize();

            this.x *= length;

            this.y *= length;

            return this;
        };

        Point.prototype.normalize = function() {
            var length = this.length();

            this.x /= length;

            this.y /= length;

            return this;
        };

        return Point;
    })();

    /*
    
    * Particle class
    
    */

    var Particle = (function() {
        function Particle() {
            this.position = new Point();

            this.velocity = new Point();

            this.acceleration = new Point();

            this.age = 0;
        }

        Particle.prototype.initialize = function(x, y, dx, dy) {
            this.position.x = x;

            this.position.y = y;

            this.velocity.x = dx;

            this.velocity.y = dy;

            this.acceleration.x = dx * settings1.particles.effect;

            this.acceleration.y = dy * settings1.particles.effect;

            this.age = 0;
        };

        Particle.prototype.update = function(deltaTime) {
            this.position.x += this.velocity.x * deltaTime;

            this.position.y += this.velocity.y * deltaTime;

            this.velocity.x += this.acceleration.x * deltaTime;

            this.velocity.y += this.acceleration.y * deltaTime;

            this.age += deltaTime;
        };

        Particle.prototype.draw = function(context, image) {
            function ease(t) {
                return --t * t * t + 1;
            }

            var size =
                image.width * ease(this.age / settings1.particles.duration);

            context.globalAlpha = 1 - this.age / settings1.particles.duration;

            context.drawImage(
                image,
                this.position.x - size / 2,
                this.position.y - size / 2,
                size,
                size
            );
        };

        return Particle;
    })();

    /*
    
    * ParticlePool class
    
    */

    var ParticlePool = (function() {
        var particles,
            firstActive = 0,
            firstFree = 0,
            duration = settings1.particles.duration;

        function ParticlePool(length) {
            // create and populate particle pool

            particles = new Array(length);

            for (var i = 0; i < particles.length; i++)
                particles[i] = new Particle();
        }

        ParticlePool.prototype.add = function(x, y, dx, dy) {
            particles[firstFree].initialize(x, y, dx, dy);

            // handle circular queue

            firstFree++;

            if (firstFree == particles.length) firstFree = 0;

            if (firstActive == firstFree) firstActive++;

            if (firstActive == particles.length) firstActive = 0;
        };

        ParticlePool.prototype.update = function(deltaTime) {
            var i;

            // update active particles

            if (firstActive < firstFree) {
                for (i = firstActive; i < firstFree; i++)
                    particles[i].update(deltaTime);
            }

            if (firstFree < firstActive) {
                for (i = firstActive; i < particles.length; i++)
                    particles[i].update(deltaTime);

                for (i = 0; i < firstFree; i++) particles[i].update(deltaTime);
            }

            // remove inactive particles

            while (
                particles[firstActive].age >= duration &&
                firstActive != firstFree
            ) {
                firstActive++;

                if (firstActive == particles.length) firstActive = 0;
            }
        };

        ParticlePool.prototype.draw = function(context, image) {
            // draw active particles

            if (firstActive < firstFree) {
                for (i = firstActive; i < firstFree; i++)
                    particles[i].draw(context, image);
            }

            if (firstFree < firstActive) {
                for (i = firstActive; i < particles.length; i++)
                    particles[i].draw(context, image);

                for (i = 0; i < firstFree; i++) particles[i].draw(context, image);
            }
        };

        return ParticlePool;
    })();

    /*
    
    * Putting it all together
    
    */

    (function(canvas) {
        var context = canvas.getContext("2d"),
            particles = new ParticlePool(settings1.particles.length),
            particleRate =
            settings1.particles.length / settings1.particles.duration, // particles/sec
            time;

        // get point on heart with -PI <= t <= PI

        function pointOnHeart(t) {
            return new Point(
                160 * Math.pow(Math.sin(t), 3),

                130 * Math.cos(t) -
                50 * Math.cos(2 * t) -
                20 * Math.cos(3 * t) -
                10 * Math.cos(4 * t) +
                25
            );
        }

        // creating the particle image using a dummy canvas

        var image = (function() {
            var canvas = document.createElement("canvas"),
                context = canvas.getContext("2d");

            canvas.width = settings1.particles.size;

            canvas.height = settings1.particles.size;

            // helper function to create the path

            function to(t) {
                var point = pointOnHeart(t);

                point.x =
                    settings1.particles.size / 2 +
                    (point.x * settings1.particles.size) / 350;

                point.y =
                    settings1.particles.size / 2 -
                    (point.y * settings1.particles.size) / 350;

                return point;
            }

            // create the path

            context.beginPath();

            var t = -Math.PI;

            var point = to(t);

            context.moveTo(point.x, point.y);

            while (t < Math.PI) {
                t += 0.01; // baby steps!

                point = to(t);

                context.lineTo(point.x, point.y);
            }

            context.closePath();

            // create the fill

            context.fillStyle = "#ee5253";

            context.fill();

            // create the image

            var image = new Image();

            image.src = canvas.toDataURL();

            return image;
        })();

        // render that thing!

        function render() {
            // next animation frame

            requestAnimationFrame(render);

            // update time

            var newTime = new Date().getTime() / 1000,
                deltaTime = newTime - (time || newTime);

            time = newTime;

            // clear canvas

            context.clearRect(0, 0, canvas.width, canvas.height);

            // create new particles

            var amount = particleRate * deltaTime;

            for (var i = 0; i < amount; i++) {
                var pos = pointOnHeart(Math.PI - 2 * Math.PI * Math.random());

                var dir = pos.clone().length(settings1.particles.velocity);

                particles.add(
                    canvas.width / 2 + pos.x,
                    canvas.height / 2 - pos.y,
                    dir.x,
                    -dir.y
                );
            }

            // update and draw particles

            particles.update(deltaTime);

            particles.draw(context, image);
        }

        // handle (re-)sizing of the canvas

        function onResize() {
            canvas.width = canvas.clientWidth;

            canvas.height = canvas.clientHeight;
        }

        window.onresize = onResize;

        // delay rendering bootstrap

        setTimeout(function() {
            onResize();

            render();
        }, 10);
    })(document.getElementById("pinkboardd"));
    </script>

    <script src="./a.js"></script>
</body>

</html>
