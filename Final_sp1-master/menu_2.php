<!DOCTYPE html>
<html>
<head>
    <title>02.01 - Globe and camera</title>

    <script src="js/build/three.js"></script>
    <script src="js/examples/js/controls/OrbitControls.js"></script>
    <script src="js/examples/js/libs/dat.gui.min.js"></script>
    <script src="js/examples/js/libs/stats.min.js"></script>
    <script src="js/examples/js/libs/EffectComposer.js"></script>
    <script src="js/examples/js/libs/RenderPass.js"></script>
    <script src="js/examples/js/libs/CopyShader.js"></script>
    <script src="js/examples/js/libs/ShaderPass.js"></script>
    <script src="js/examples/js/libs/MaskPass.js"></script>
    <script src="js/examples/js/utils/GeometryUtils.js"></script>
       <style>
            body {
                /* set margin to 0 and overflow to hidden, to go fullscreen */
                margin: 0;
                overflow: hidden;
                }
            </style>
        </head>
        <script>
        //ticks
        var ticks = 1;
        var interrupt = 0;
        var handler=1;
        var selected_country;
        // global variables

        var renderer;
        var scene;
        var camera;
        var control;
        var stats;
        var cameraControl;
        // background stuff
        var cameraBG;
        var sceneBG;
        var composer;
        var clock;
        var params = { opacity: 0.50};
        /**
        * Initializes the scene, camera and objects. Called when the window is
        * loaded by using window.onload (see below)
        */
        function init() {
            clock = new THREE.Clock();
            // create a scene, that will hold all our elements such as objects, cameras and lights.
            scene = new THREE.Scene();
            // create a camera, which defines where we're looking at.
            camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);


            // create a render, sets the background color and the size
            renderer = new THREE.WebGLRenderer();
            renderer.setClearColor(0x000000, 1.0);
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.shadowMapEnabled = true;
            // create a sphere
            var sphereGeometry = new THREE.SphereGeometry(15, 60, 60);
            var sphereMaterial = createEarthMaterial();
            var earthMesh = new THREE.Mesh(sphereGeometry, sphereMaterial);
            earthMesh.name = 'earth';
            earthMesh.position.z = 12;
            earthMesh.position.x = -15;
            scene.add(earthMesh);
            // create a cloudGeometry, slighly bigger than the original sphere
            var cloudGeometry = new THREE.SphereGeometry(15.3, 60, 60);
            var cloudMaterial = createCloudMaterial();
            var cloudMesh = new THREE.Mesh(cloudGeometry, cloudMaterial);
            cloudMesh.name = 'clouds';
            cloudMesh.position.z = 12;
            cloudMesh.position.x = -15
            scene.add(cloudMesh);
            // now add some better lighting
            var ambientLight = new THREE.AmbientLight(0x555555);
            ambientLight.name='ambient';
            scene.add(ambientLight);
            // add sunlight (light
            var directionalLight = new THREE.DirectionalLight(0xffffff, 1);
            directionalLight.position = new THREE.Vector3(100,10,-50);
            directionalLight.name='directional';
            scene.add(directionalLight);


            //point lights
            var light = new THREE.PointLight( 0xffff00, 1, 100);
            light.position.set( 15, 10, 15 );
            scene.add( light );
            var light = new THREE.PointLight( 0x0000ff, 1, 100);
            light.position.set( 19, 10, 19 );
            scene.add( light );


            //MENU BUTTONS
            var length = 8, width = 8;

                var shape = new THREE.Shape();
                shape.moveTo( 0,0 );
                shape.lineTo( 0, width );
                shape.lineTo( length, width );
                shape.lineTo( length, 0 );
                shape.lineTo( 0, 0 );

                var extrudeSettings = {
                    steps: 2,
                    depth: 16,
                    bevelEnabled: true,
                    bevelThickness: 1,
                    bevelSize: 1,
                    bevelSegments: 1
                };

            var geometry1 = new THREE.ExtrudeGeometry( shape, extrudeSettings );
                var material1 = new THREE.MeshStandardMaterial( {
                    opacity: params.opacity,
                    transparent: true
                } );

                var material2 = new THREE.MeshStandardMaterial( {
                    opacity: params.opacity,
                    premultipliedAlpha: true,
                    transparent: true
                } );
                var mesh_menu = new THREE.Mesh( geometry1, material1 );
                mesh_menu.name ='extruded';
                mesh_menu.rotation.y=-Math.PI /4;
                mesh_menu.position.x = 15;


                scene.add( mesh_menu );
                //CAPTION OF MENU

                /*                MENU TITLE                        */
                var loader = new THREE.FontLoader();
              loader.load( 'js/examples/fonts/helvetiker_regular.typeface.json', function ( font ) {
                var geometry_menu = new THREE.TextGeometry( 'MENU', {
                  font: font,
                  size: 1,
                  height: 1,
                  curveSegments: 12,

                } );
                var materials_menu= new THREE.MeshPhongMaterial({color: 0x5c95f2});
                 var mesh_menu_title = new THREE.Mesh(geometry_menu, materials_menu);
                 mesh_menu_title.position.x = 8;
                  mesh_menu_title.position.z =8;
                 mesh_menu_title.position.y=8;
                 mesh_menu_title.rotation.y = Math.PI /4;
                 mesh_menu_title.name = 'menu';
                 scene.add(mesh_menu_title);
             });
              var loader = new THREE.FontLoader();
              loader.load( 'js/examples/fonts/optimer_bold.typeface.json', function ( font ) {
                var geometry_menu = new THREE.TextGeometry( 'Select Language', {
                  font: font,
                  size: 1,
                  height: 1,
                  curveSegments: 12,

                } );
                var materials_menu= new THREE.MeshPhongMaterial({color: 0xffffff});
                 var mesh_menu_title = new THREE.Mesh(geometry_menu, materials_menu);
                 mesh_menu_title.position.x = 0;
                  mesh_menu_title.position.z =8;
                 mesh_menu_title.position.y=4   ;
                 mesh_menu_title.rotation.y = Math.PI /4;
                 mesh_menu_title.callback = function() { select_language();}
                 mesh_menu_title.name = 'select_lang';
                 var raycaster = new THREE.Raycaster();
                 var mouse = new THREE.Vector2();
                      scene.add(mesh_menu_title);



             });
               var loader = new THREE.FontLoader();
              loader.load( 'js/examples/fonts/optimer_bold.typeface.json', function ( font ) {
                var geometry_menu = new THREE.TextGeometry( 'Start', {
                  font: font,
                  size: 1,
                  height: 1,
                  curveSegments: 12,

                } );
                var materials_menu= new THREE.MeshPhongMaterial({color: 0xffffff});
                 var mesh_menu_title = new THREE.Mesh(geometry_menu, materials_menu);
                 mesh_menu_title.position.x = 0;
                  mesh_menu_title.position.z =8;
                 mesh_menu_title.position.y=1   ;
                 mesh_menu_title.rotation.y = Math.PI /4;
                 mesh_menu_title.name = 'start';
                 mesh_menu_title.callback = function() { comenzar();}
                 var raycaster = new THREE.Raycaster();
                 var mouse = new THREE.Vector2();
                      scene.add(mesh_menu_title);


             });
                 /*                END OF MENU TITLE                        */
                //END OF CAPTION OF MENU
            // position and point the camera to the center of the scene
            camera.position.x = 27.17;
            camera.position.y = 5.65;
            camera.position.z = 24.83;
            camera.lookAt(scene.position);
            // add controls
            cameraControl = new THREE.OrbitControls(camera);
            /*
              1. Save the current state if needed later
             setup the control object for the control gui */
            old_max_p = cameraControl.maxPolarAngle;
            old_min_p = cameraControl.minPolarAngle;
            old_max_a = cameraControl.maxAzimuthAngle;
            old_min_a = cameraControl.minAzimuthAngle;
            cameraControl.maxPolarAngle =  Math.PI /2 + 0.2;
            cameraControl.maxAzimuthAngle =  Math.PI /4 +0.2 ;
           cameraControl.minPolarAngle =  Math.PI /2 - 0.2;
            cameraControl.minAzimuthAngle =  Math.PI /4 -0.2;

            control = new function () {
            this.rotationSpeed = 0.001;
            this.ambientLightColor = ambientLight.color.getHex();
            this.directionalLightColor = directionalLight.color.getHex();
            };
            // add extras
            addControlGui(control);
            addStatsObject();
            // add background using a camera
            cameraBG = new THREE.OrthographicCamera(-window.innerWidth, window.innerWidth, window.innerHeight, -window.innerHeight, -10000, 10000);
            cameraBG.position.z = 50;
            sceneBG = new THREE.Scene();
            var materialColor = new THREE.MeshBasicMaterial({ map: THREE.ImageUtils.loadTexture("images/starry_background.jpg"), depthTest: false });
            var bgPlane = new THREE.Mesh(new THREE.PlaneGeometry(1, 1), materialColor);
            bgPlane.position.z = -100;
            bgPlane.scale.set(window.innerWidth * 2, window.innerHeight * 2, 1);
            sceneBG.add(bgPlane);
            // setup the composer steps
            // first render the background
            var bgPass = new THREE.RenderPass(sceneBG, cameraBG);
            // next render the scene (rotating earth), without clearing the current output
            var renderPass = new THREE.RenderPass(scene, camera);
            renderPass.clear = false;
            // finally copy the result to the screen
            var effectCopy = new THREE.ShaderPass(THREE.CopyShader);
            effectCopy.renderToScreen = true;

            /* detectar clicks */


            // add these passes to the composer
            composer = new THREE.EffectComposer(renderer);
            composer.addPass(bgPass);
            composer.addPass(renderPass);
            composer.addPass(effectCopy);
            // add the output of the renderer to the html element
            document.body.appendChild(renderer.domElement);
            // call the render function, after the first render, interval is determined
            // by requestAnimationFrame







            render();
        }
var raycaster = new THREE.Raycaster();
var mouse = new THREE.Vector2();

function onMouseMove( event ) {

    // calculate mouse position in normalized device coordinates
    // (-1 to +1) for both components

    mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
    mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;
//  console.log("mouse x: " + mouse.x);

}
        function createEarthMaterial() {
            // 4096 is the maximum width for maps
            var earthTexture = THREE.ImageUtils.loadTexture("images/earthmap4k.jpg");
            var earthMaterial = new THREE.MeshPhongMaterial();
            earthMaterial.map = earthTexture;
            var normalMap = THREE.ImageUtils.loadTexture( "images/earth_normalmap_flat4k.jpg");
             earthMaterial.normalMap = normalMap;
             earthMaterial.normalScale = new THREE.Vector2(0.5, 0.7);
             var specularMap = THREE.ImageUtils.loadTexture(
             "images/earthspec4k.jpg");
             earthMaterial.specularMap = specularMap;
             earthMaterial.specular = new THREE.Color(0x262626);
            return earthMaterial;
            }
        function createCloudMaterial() {
            var cloudTexture = THREE.ImageUtils.loadTexture("images/fair_clouds_4k.png");
            var cloudMaterial = new THREE.MeshPhongMaterial();
            cloudMaterial.map = cloudTexture;
            cloudMaterial.transparent = true;
            return cloudMaterial;
            }
        function addControlGui(controlObject) {
            var gui = new dat.GUI();
            gui.add(controlObject, 'rotationSpeed', -0.01, 0.01);
            gui.addColor(controlObject, 'ambientLightColor');
            gui.addColor(controlObject, 'directionalLightColor');
            }
        function addStatsObject() {
            stats = new Stats();
            stats.setMode(0);
            stats.domElement.style.position = 'absolute';
            stats.domElement.style.left = '0px';
            stats.domElement.style.top = '0px';
            document.body.appendChild(stats.domElement);
            }
        /**
        * Called when the scene needs to be rendered. Delegates to requestAnimationFrame
        * for future renders
        */
        function render() {
            // update stats
            stats.update();
            // update the camera
          //  console.log(toint);
            cameraControl.update();
            if (this.handler==1) {


            if (this.interrupt==0) {
              if (this.ticks==1)
              {
                scene.getObjectByName('earth').rotation.y+=control.rotationSpeed;
                scene.getObjectByName('clouds').rotation.y+=control.rotationSpeed*1.1;
              }
            }
            else{
              scene.getObjectByName('earth').rotation.y-=control.rotationSpeed*3;
              scene.getObjectByName('clouds').rotation.y-=control.rotationSpeed*1.1*3;
              is_zero();
            }
          }


            // update light colors
            scene.getObjectByName('ambient').color = new THREE.Color(control.ambientLightColor);
            scene.getObjectByName('directional').color = new THREE.Color(control.directionalLightColor);
            // and render the scene, renderer shouldn't autoclear, we let the composer steps do that themselves
            // rendering is now done through the composer, which executes the render steps
            //menuhandler
           //console.log("X: "+ camera.position.x+ "Y: " +camera.position.y+ "Z: "+camera.position.z);
           raycaster.setFromCamera( mouse, camera );

            // calculate objects intersecting the picking ray
            var intersects = raycaster.intersectObjects( scene.children );
            window.addEventListener( 'mousemove', onMouseMove, false );
               renderer.render( scene, camera );
            //ende menu
            renderer.autoClear = false;
            composer.render();
            // render using requestAnimationFrame
            requestAnimationFrame(render);
            }
        /**
        * Function handles the resize event. This make sure the camera and the renderer
        * are updated at the correct moment.
        */
        function handleResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
            }
        // calls the init function when the window is done loading.
        window.onload = init;
        // calls the handleResize function when the window is resized
        window.addEventListener('resize', handleResize, false);
/*callbacks*/
window.addEventListener('click', onDocumentMouseDown, false);
function onDocumentMouseDown( event ) {
    event.preventDefault();
    mouse.x = ( event.clientX / renderer.domElement.clientWidth ) * 2 - 1;
    mouse.y = - ( event.clientY / renderer.domElement.clientHeight ) * 2 + 1;
    raycaster.setFromCamera( mouse, camera );
    console.log(scene.children);
    var intersects = raycaster.intersectObjects( scene.children );
    console.log(intersects[1]);
    if ( intersects.length > 0 ) {
        if (intersects[1].object.name=='earth')
        {
            if (intersects[1].object.children[0].name=="usa_point")
            {
                console.log("usa point");
                location.href="lesson1.php?lang=us";
            }
            if (intersects[1].object.children[0].name=="sp_point")
            {
                console.log("sp point");
                location.href="menu_form.php?lang=sp";
            }
        }
        intersects[1].object.callback();
    }
}
/* function select_language removes certain childs, "select language, menu, comenzar"*/
function select_language()
{
  var selectedObject = scene.getObjectByName("select_lang");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("start");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("menu");
  scene.remove( selectedObject );
  entry_language();

}
function comenzar()
{
  var selectedObject = scene.getObjectByName("select_lang");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("start");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("menu");
  scene.remove( selectedObject );

}
/*CALLS FUNCTION TO DISPLAY LANGUAGES IN DEFINED POSITION */
function Rotate(par1, par2, par3)
{
  this.selected_country = par1;
  cameraControl.saveState();
  this.ticks=0;
  this.interrupt=1;



}
/*if is zero will handle it and try to focus on a country*/
function is_zero()
{
  if (scene.getObjectByName('earth').rotation.y<=0)
  {
      /*disable stuff here*/
      console.log("Disabling stuff...");
      scene.getObjectByName('earth').rotation.y = 0;
      scene.getObjectByName('clouds').rotation.y = 0;
      this.handler=0;
      this.interrupt=1;
      disable_objects();
  }

}
function disable_objects()
{
scene.remove(scene.getObjectByName('extruded'));
scene.remove(scene.getObjectByName('eng_but'));
scene.remove(scene.getObjectByName('span_but'));
switch (this.selected_country) {
  case "en":
  console.log("Moving to united states");
  move_to_en();
    break;
    case "sp":
    console.log("Moviendo a latino america");
    move_to_sp();
      break;
  default:

}
}
function move_to_en()
{
    var usa_point = new THREE.SphereGeometry(1, 1, 1);
    var usa_mat = new THREE.MeshPhongMaterial({color: 0xff0000});;
    var usa_m = new THREE.Mesh(usa_point, usa_mat);
    usa_m.name = 'usa_point';
   cameraControl.maxPolarAngle =  old_max_p;
   cameraControl.maxAzimuthAngle =  old_max_a;
   cameraControl.minPolarAngle =  old_min_p;
   cameraControl.minAzimuthAngle = old_min_a;
    var teta = 2*Math.PI;
    var rho = 2*Math.PI;
    var x = 11*Math.sin(teta)*Math.cos(rho) - 2;
    var y = 11*Math.sin(teta)*Math.sin(rho) + 10;
    var z = 11*Math.cos(teta);
    usa_m.position.x=x;
    usa_m.position.y=y;
    usa_m.position.z=z;
    scene.getObjectByName('earth').add(usa_m);
    cameraControl.target = new THREE.Vector3(x-15,y,z+12);
    camera.position.x=-21.76;
    camera.position.y=31.78;
    camera.position.z=61.42;
    console.log(camera.getworldDirection);
}
function move_to_sp()
{
    var sp_point = new THREE.SphereGeometry(1, 1, 1);
    var sp_mat = new THREE.MeshPhongMaterial({color: 0x00ff00});;
    var sp_m = new THREE.Mesh(sp_point, sp_mat);
    sp_m.name = 'sp_point';
    cameraControl.maxPolarAngle =  old_max_p;
    cameraControl.maxAzimuthAngle =  old_max_a;
    cameraControl.minPolarAngle =  old_min_p;
    cameraControl.minAzimuthAngle = old_min_a;
    var teta = 2*Math.PI;
    var rho = 2*Math.PI;
    var x = 15*Math.sin(teta)*Math.cos(rho)+5;
    var y = 15*Math.sin(teta)*Math.sin(rho);
    var z = 15*Math.cos(teta);
    sp_m.position.x=x;
    sp_m.position.y=y;
    sp_m.position.z=z;
    scene.getObjectByName('earth').add(sp_m);
    cameraControl.target = new THREE.Vector3(x-15,y,z+12);
    camera.position.x=2.84;
    camera.position.y=2.56;
    camera.position.z=62.31 ;
    console.log(cameraControl.target);
}
function entry_language()
{
  //ENGLISH
  /*
    define just a variable pointing to a function that it will be the callback
    function defined to handle the object!
  */


  display_text("English", 0, 4, 8, 0xffffff, "eng_but", "en",0,0);
  //SPANISH
  display_text("Spanish", 0, 1, 8, 0xffffff, "span_but", "sp",0,0);
}

/*
text to appear
posx position in x
posy position in y
posz position in z
color has to be hex 0xffffff
mesh_name will identify the object for the object handler detector
last three are three parameters to a the function callback
*/
function display_text(text, posx, posy, posz, color, mesh_name, func_par1, func_par2, func_par3)
{
  var loader = new THREE.FontLoader();
  loader.load( 'js/examples/fonts/optimer_bold.typeface.json', function ( font ) {
    var geometry_menu = new THREE.TextGeometry( text, {
      font: font,
      size: 1,
      height: 1,
      curveSegments: 12,

    } );
    var materials_menu= new THREE.MeshPhongMaterial({color: color});
     var mesh_menu_title = new THREE.Mesh(geometry_menu, materials_menu);
     mesh_menu_title.position.x = posx;
     mesh_menu_title.position.z =posz;
     mesh_menu_title.position.y=posy;
     mesh_menu_title.rotation.y = Math.PI /4;
     mesh_menu_title.callback = function(){Rotate(func_par1,func_par2,func_par3);};
     mesh_menu_title.name = mesh_name;

          scene.add(mesh_menu_title);



 });
}

        </script>
<body>
</body>
</html>
