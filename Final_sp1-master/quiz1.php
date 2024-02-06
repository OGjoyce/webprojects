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
      #text {
    position: absolute;
    display: block;
    z-index: 99;
    left: 80%;
    top: 60%;
    width:10%;
    height: 5%;
    color: black;
    font-style: italic;
    font-size: 30px;
    }
    #quiz_btn {
  position: absolute;
  display: block;
  z-index: 99;
  left: 80%;
  top: 95%;
  width:10%;
  height: 5%;
  background-color: tomato;
  font-style: italic;
  font-size: 30px;
  }
  #sponge_bob{
    position: absolute;
    display: block;
    z-index: 99;
    left: 80%;
    top: 50%;
    width:10%;
    height: 5%;
    font-style: italic;
    font-size: 30px;

  }
  #btn_go
  {
    width: 80px;
    height: 50px;
    background-color: tomato;
    font-style: italic;
    font-size: 30px;
  }

		</style>
<p id=text>*Type the correct translation for every object*</p>
<button id=quiz_btn onclick="javascript:location.href='lesson1.php'">Lesson 1</button>
<div id="sponge_bob">
<input id="ipt" type="text" placeholder="Type here..." >
<button id="btn_go" onclick="javascript:go()" >Go</button>
</div>
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
       var geometry_menu = new THREE.TextGeometry( 'Quiz One', {
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
    LOGIC GOES HERE
    */

    var incremental = 4;

    for (var a=[],i=0;i<4;++i) a[i]=i;
    function shuffle(array) {
    var tmp, current, top = array.length;
    if(top) while(--top) {
     current = Math.floor(Math.random() * (top + 1));
     tmp = array[current];
     array[current] = array[top];
     array[top] = tmp;
    }
    return array;
    }

    a = shuffle(a);
    console.log(a);

    /**/
    var to_condition = "";
    function show_words(engtxt, sptxt)
    {

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
    /**/

/*
  show_input, enables an input and a button waits for the user to input, then

*/
var k, o;
var conditional_variable = false;
function go()
{
 conditional_variable=true;
 console.log("conditional+1");
 var answer = document.getElementById("ipt").value;
 answer = answer.toLowerCase();
 if (answer === k)
 {
   console.log(answer +" "+ k);
   a.pop();
   display_objects();
 }
 else
 {
    alert("Respuesta incorrecta");
 }

}
function show_input(key, obj)
{
  key = key.toLowerCase();
  k = key;
  o = obj;


}
/*
  end of show_input
*/


function display_objects(){
 for (var i = a.length-1; i > a.length-2; i--)
 {
   console.log(a[i]);
   if (a[i]==0)
   {
    destroy_apple();
    destroy_cactus();
    destroy_skeleton();
    destroy_wizard();
    var objec = show_skeleton();
   show_input("Human Skeleton", objec);


   }
   if (a[i]==1)
   {
    destroy_apple();
    destroy_cactus();
    destroy_skeleton();
    destroy_wizard();
    var objec = show_wizard();
   show_input("Wizard", objec);


   }
   if (a[i]==2)
   {
    destroy_apple();
    destroy_cactus();
    destroy_skeleton();
    destroy_wizard();
    var objec = show_apple();
   show_input("Apple", objec);


   }
   if (a[i]==3)
   {
    destroy_apple();
    destroy_cactus();
    destroy_skeleton();
    destroy_wizard();
    var objec = show_cactus();
   show_input("cactus", objec);


   }

 }


if (a.length == 0)
{
  alert("Quiz terminado 100/100");
}

}
display_objects();






    /*
    END OF LOGIC
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

        </head>
</html>
