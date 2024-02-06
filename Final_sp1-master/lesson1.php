<!DOCTYPE html>
<html>
<head>
    <title>02.01 - Globe and camera</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <script src="js/build/three.js"></script>
    <script src="js/examples/js/controls/OrbitControls.js"></script>
    <script src="js/examples/js/libs/dat.gui.min.js"></script>
    <script src="js/examples/js/libs/jszip.min.js"></script>
    <script src="js/examples/js/libs/stats.min.js"></script>
    <script src="js/examples/js/WebGL.js"></script>
    <script src="js/examples/js/loaders/AMFLoader.js"></script>
    <script src="js/examples/js/loaders/FBXLoader.js"></script>
    <script src="js/examples/js/libs/inflate.min.js"></script>
    <script src="js/examples/js/renderers/CSS3DRenderer.js"></script>
    <script src ="js_functions.js"></script>

    <style>
			body {
				font-family: Monospace;
				background-color: #000000;
				margin: 0px;
				overflow: hidden;
			}
			#info {
				color: #fff;
				position: absolute;
				top: 10px;
				width: 100%;
				text-align: center;
				z-index: 100;
				display:block;
			}
			a { color: skyblue }
			.button { background:#999; color:#eee; padding:0.2em 0.5em; cursor:pointer }
			.highlight { background:orange; color:#fff; }
			span {
				display: inline-block;
				width: 60px;
				text-align: center;
			}
      #next {
    position: absolute;
    display: block;
    z-index: 99;
    left: 80%;
    top: 70%;
    width:10%;
    height: 5%;
    background-color: green;
    font-style: italic;
    font-size: 15px;
    }
    #back {
  position: absolute;
  display: block;
  z-index: 99;
  left: 10%;
  top: 70%;
  width:10%;
  height: 5%;
  background-color: yellowgreen;
  font-style: italic;
  font-size: 15px;
  }
  #start
  {
    position: absolute;
    display: block;
    z-index: 99;
    left: 45%;
    top: 80%;
    width:10%;
    height: 5%;
    background-color: cyan;
    font-style: italic;
    font-size: 15px;
  }
  #text{
    position: absolute;
    display: block;
    z-index: 99;
    left: 80%;
    top: 50%;
    width:10%;
    height: 5%;
    color: black;
    font-style: italic;
    font-size: 30px;
  }
		</style>
<p id=text >*Click the next button*</p>
    <body>

      <script>
    if ( WEBGL.isWebGLAvailable() === false ) {
      document.body.appendChild( WEBGL.getWebGLErrorMessage() );
    }
    var camera, scene, renderer;


      scene = new THREE.Scene();
      scene.background = new THREE.Color( 0x999999 );
      scene.add( new THREE.AmbientLight( 0x999999 ) );
      camera = new THREE.PerspectiveCamera( 35, window.innerWidth / window.innerHeight, 1, 500 );
      // Z is up for objects intended to be 3D printed.
      camera.up.set( 0, 0, 1 );
      camera.position.set( 0, - 11, 6 );
      camera.add( new THREE.PointLight( 0xffffff, 0.8 ) );
      scene.add( camera );
      var grid = new THREE.GridHelper( 50, 50, 0xffffff, 0x555555 );
      grid.rotateOnAxis( new THREE.Vector3( 1, 0, 0 ), 90 * ( Math.PI / 180 ) );
      scene.add( grid );
      renderer = new THREE.WebGLRenderer( { antialias: true } );
      renderer.setPixelRatio( window.devicePixelRatio );
      renderer.setSize( window.innerWidth, window.innerHeight );
      document.body.appendChild( renderer.domElement );
      //var loader = new THREE.AMFLoader();
      //loader.load( 'lesson1/apple.amf', function ( amfobject ) {
      //  scene.add( amfobject );});


      /*
      Create text with "Lesson1"

      */
      var loader = new THREE.FontLoader();
     loader.load( 'js/examples/fonts/optimer_bold.typeface.json', function ( font ) {
       var geometry_menu = new THREE.TextGeometry( 'Lesson One', {
         font: font,
         size: 1,
         height: 1,
         curveSegments: 12,

       } );
       var materials_menu= new THREE.MeshPhongMaterial({color: 'tomato'});
        var mesh_menu_title = new THREE.Mesh(geometry_menu, materials_menu);
        mesh_menu_title.name = 'LessonOne';
        mesh_menu_title.position.x = -2;
        mesh_menu_title.rotation.x = Math.PI /2;
        mesh_menu_title.position.y = 35;
        mesh_menu_title.position.z = 2;
        //mesh_menu_title.position.z = -35;
        mesh_menu_title.callback = function() { true;}
        var raycaster = new THREE.Raycaster();
        var mouse = new THREE.Vector2();
             scene.add(mesh_menu_title);


    });

      /*
        END OF TEXT
      */

      /*
      SHOW WORDS translated
      */
      function show_words(engtxt, sptxt)
      {
        var loader = new THREE.FontLoader();
      loader.load( 'js/examples/fonts/helvetiker_regular.typeface.json', function ( font ) {
        var geometry_menu = new THREE.TextGeometry( engtxt, {
          font: font,
          size: 1,
          height: 1,
          curveSegments: 12,

        } );
        var materials_menu= new THREE.MeshPhongMaterial({color: 0x5c95f2});
         var mesh_menu_title = new THREE.Mesh(geometry_menu, materials_menu);
         mesh_menu_title.position.x = 5;
         mesh_menu_title.position.y = 20;
          mesh_menu_title.rotation.x = Math.PI /2;
         mesh_menu_title.name = 'english_word';
         scene.add(mesh_menu_title);
     });
      var loader = new THREE.FontLoader();
      loader.load( 'js/examples/fonts/optimer_bold.typeface.json', function ( font ) {
        var geometry_menu = new THREE.TextGeometry( sptxt, {
          font: font,
          size: 1,
          height: 1,
          curveSegments: 12,

        } );
        var materials_menu= new THREE.MeshPhongMaterial({color: 'chocolate'});
         var mesh_menu_title = new THREE.Mesh(geometry_menu, materials_menu);
         mesh_menu_title.position.x = -15;
         mesh_menu_title.position.y = 20;
         mesh_menu_title.rotation.x = Math.PI /2;
         mesh_menu_title.name = 'spanish_word';
         var raycaster = new THREE.Raycaster();
         var mouse = new THREE.Vector2();
              scene.add(mesh_menu_title);



     });
      }


      /*
      SHOW INPUT if already got all THE WORDS
      */
      function show_input_start()
      {
        document.getElementById('start').style = "block";
      }
      function start_quiz()
      {
        location.href="quiz1.php";
      }
      /*
      */
      var i = 0;

      function next()
      {
        var element = document.getElementById('text');
        if (element != null) {
            element.parentNode.removeChild(element);
        }


        switch (i) {
          case 0:
          show_skeleton();
            break;
            case 1:
            destroy_skeleton();
            show_wizard();
            break;
            case 2:
            destroy_wizard();
            show_apple();
            break;
            case 3:
            destroy_apple();
            show_cactus();
            show_input_start();
            break;
          default:

        }
        if (i<4)
        {
              i++;
        }

        console.log(i);


      }
      function back()
      {
        switch (i) {
          case 0:
          destroy_skeleton();
            break;
            case 1:
            destroy_wizard();
            destroy_skeleton();
            destroy_apple();
            break;
            case 2:
            show_wizard();
            destroy_apple();;
            destroy_skeleton();
            destroy_apple();
            break;
            case 3:
            show_apple();
            destroy_cactus();
            destroy_wizard();
            destroy_skeleton();
            break;
          default:

        }
        if (i>0)
        {
              i--;
        }


        console.log(i);


      }

      /*
      END NEXT BUTTON
      */
      var controls = new THREE.OrbitControls( camera, renderer.domElement );
      controls.addEventListener( 'change', render );
      controls.target.set( 0, 1.2, 2 );
      controls.update();
      window.addEventListener( 'resize', onWindowResize, false );
      render();




    function onWindowResize() {
      camera.aspect = window.innerWidth / window.innerHeight;
      camera.updateProjectionMatrix();
      renderer.setSize( window.innerWidth, window.innerHeight );

    }
    function render() {
      renderer.render( scene, camera );

    }

  </script>

    </body>
    <button id="next" onclick="next()">Next</button>
    <button id="back" onclick="back()">Back</button>
    <button id="start" onclick="start_quiz()" style="display: none;" >Start Quiz</button>
        </head>
</html>
