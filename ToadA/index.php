<html><body>
<title>Planète Toad &bull; Toad Airplane</title>
<meta name="description" content="Jouer au jeu Toad Airplane sur Planète Toad">
<?php if (date("H")<6 OR date("H")>21) {
echo'<style type="text/css">body{margin:0;padding:0;background-attachment:fixed;background-repeat:repeat;background-image:url(/images/background2V3.jpg);font-size:13px;overflow:hidden}</style>';
} else {
echo'<style type="text/css">body{margin:0;padding:0;background-attachment:fixed;background-repeat:repeat;background-image:url(/images/backgroundDay.jpg);font-size:13px;overflow:hidden}</style>';
} ?>
<style>
body{margin:0;padding:0;font-size:13px;overflow:hidden;}
#canvasArea{margin-left:auto;margin-right:auto;overflow:hidden;}	
p{color:white;}
</style>
<!-- Libs and GDJS core files : -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="libs/pixi.js"></script>
<script src="libs/jshashtable.js"></script>
<script src="gd.js"></script>
<script src="libs/hshg.js"></script>
<script src="commontools.js"></script>
<script src="runtimeobject.js"></script>
<script src="runtimescene.js"></script>
<script src="polygon.js"></script>
<script src="force.js"></script>
<script src="layer.js"></script>
<script src="timer.js"></script>
<script src="imagemanager.js"></script>
<script src="runtimegame.js"></script>
<script src="variable.js"></script>	
<script src="variablescontainer.js"></script>
<script src="eventscontext.js"></script>
<script src="runtimeautomatism.js"></script>
<script src="spriteruntimeobject.js"></script>
<script src="soundmanager.js"></script>
<script src="runtimescenetools.js"></script>
<script src="inputtools.js"></script>
<script src="objecttools.js"></script>
<script src="cameratools.js"></script>
<script src="soundtools.js"></script>
<script src="storagetools.js"></script>
<script src="stringtools.js"></script>
<script src="windowtools.js"></script>
<script src="Extensions/TextObject/textruntimeobject.js"></script>
<script src="code0.js"></script>
<script src="Extensions/PhysicsAutomatism/box2djs/box2d.js"></script>
<script src="Extensions/PhysicsAutomatism/physicsruntimeautomatism.js"></script>
<script src="code1.js"></script>
<script src="data.js"></script>
</head>
<body>
<div id="canvasArea"></div>
<script src="index.js" type="text/javascript"></script>
</body></html>