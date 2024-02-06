/*
END OF translated
*/
/*
draw skeleton
*/
function show_skeleton(){
  var selectedObject = scene.getObjectByName("english_word");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("spanish_word");
  scene.remove( selectedObject );
var loader = new THREE.FBXLoader();
  loader.load( 'lesson1/skeleton.fbx', function ( object ) {
    object.rotation.x = Math.PI/2;
    object.position.z = 0.5;
    object.position.y = 2;
    object.scale.set(2,2,2);
    object.name='skeleton';
    scene.add( object );
  } );
    show_words("Human Skeleton", "Esqueleto Humano");
//  render();
}

function destroy_skeleton()
{
  var selectedObject = scene.getObjectByName("skeleton");
  scene.remove( selectedObject );

}
//show_skeleton();
/*
end of skeleton
*/


/*DRAW APPLE*/
function show_apple()
{
  var selectedObject = scene.getObjectByName("english_word");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("spanish_word");
  scene.remove( selectedObject );
  var loader = new THREE.FBXLoader();
  loader.load('lesson1/apple.fbx', function(object)
  {object.rotation.x = Math.PI/2;
  object.position.z = 1;
  object.position.y = 2;
  object.scale.set(7,7,7);
  object.name='apple';
    scene.add(object);
  });
  show_words("Apple", "Manzana");
}
function destroy_apple()
{
  var selectedObject = scene.getObjectByName("apple");
  scene.remove( selectedObject );
}
//show_apple();

/* END OF PAPLE*/

/*
  SHOW WIZARD
*/
function show_wizard()
{
  var selectedObject = scene.getObjectByName("english_word");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("spanish_word");
  scene.remove( selectedObject );
  var loader = new THREE.FBXLoader();
  loader.load('lesson1/wizard.fbx', function(object)
  {object.rotation.x = Math.PI/2;
  object.position.z = 2;
  object.position.y = 2;
  object.scale.set(7,7,7);
  object.name='wizard';
    scene.add(object);
  });
  show_words("Wizard", "Mago");
}
function destroy_wizard()
{
  var selectedObject = scene.getObjectByName("wizard");
  scene.remove( selectedObject );
}
//show_wizard();
/*
  END WIZARD
*/
/*
SHOW CACTUS
*/
function show_cactus()
{
  var selectedObject = scene.getObjectByName("english_word");
  scene.remove( selectedObject );
  var selectedObject = scene.getObjectByName("spanish_word");
  scene.remove( selectedObject );
  var loader = new THREE.FBXLoader();
  loader.load('lesson1/cactus.fbx', function(object)
  {object.rotation.x = Math.PI/2;
  object.position.z = 2;
  object.position.y = 2;
  object.scale.set(7,7,7);
  object.name='cactus';
    scene.add(object);
  });
  show_words("Cactus", "Cactus");
}
function destroy_cactus()
{
  var selectedObject = scene.getObjectByName("cactus");
  scene.remove( selectedObject );
}
//show_cactus();
/*
END CACTUS
*/

/*
SHOW NEXT BUTTON
*/
// create the dom Element
