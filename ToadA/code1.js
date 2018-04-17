gdjs.JeuCode = {};


gdjs.JeuCode.GDToadObjects1= [];
gdjs.JeuCode.GDMissileObjects1= [];
gdjs.JeuCode.GDSuperMissileObjects1= [];
gdjs.JeuCode.GDPVObjects1= [];
gdjs.JeuCode.GDKoopaObjects1= [];
gdjs.JeuCode.GDScoreObjects1= [];
gdjs.JeuCode.GDDeadKoopaObjects1= [];
gdjs.JeuCode.GDGameOverObjects1= [];
gdjs.JeuCode.GDBlocObjects1= [];
gdjs.JeuCode.GDNuageObjects1= [];
gdjs.JeuCode.GDBarre1Objects1= [];
gdjs.JeuCode.GDTempsObjects1= [];

gdjs.JeuCode.conditionTrue_0 = {val:false};
gdjs.JeuCode.condition0IsTrue_0 = {val:false};
gdjs.JeuCode.condition1IsTrue_0 = {val:false};
gdjs.JeuCode.condition2IsTrue_0 = {val:false};
gdjs.JeuCode.condition3IsTrue_0 = {val:false};
gdjs.JeuCode.condition4IsTrue_0 = {val:false};

gdjs.JeuCode.func = function(runtimeScene, context) {
context.startNewFrame();
gdjs.JeuCode.GDToadObjects1.length = 0;
gdjs.JeuCode.GDMissileObjects1.length = 0;
gdjs.JeuCode.GDSuperMissileObjects1.length = 0;
gdjs.JeuCode.GDPVObjects1.length = 0;
gdjs.JeuCode.GDKoopaObjects1.length = 0;
gdjs.JeuCode.GDScoreObjects1.length = 0;
gdjs.JeuCode.GDDeadKoopaObjects1.length = 0;
gdjs.JeuCode.GDGameOverObjects1.length = 0;
gdjs.JeuCode.GDBlocObjects1.length = 0;
gdjs.JeuCode.GDNuageObjects1.length = 0;
gdjs.JeuCode.GDBarre1Objects1.length = 0;
gdjs.JeuCode.GDTempsObjects1.length = 0;


{



}


{

gdjs.JeuCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "Up");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDToadObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDToadObjects1[i].addForce(0, -5, 0.0001);
}
}}

}


{

gdjs.JeuCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "Down");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDToadObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDToadObjects1[i].addForce(0, 5, 0.0001);
}
}}

}


{


gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "LShift");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.unpauseTimer(runtimeScene, "Frein");
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "Frein");
}}

}


{

gdjs.JeuCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 0.1, "Frein");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDToadObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDToadObjects1[i].clearForces();
}
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "Frein");
}{gdjs.evtTools.runtimeScene.pauseTimer(runtimeScene, "Frein");
}}

}


{



}


{

gdjs.JeuCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));
gdjs.JeuCode.GDMissileObjects1.length = 0;

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "Space");
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 0.5, "Tir");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{gdjs.evtTools.object.createObjectOnScene(runtimeScene, context.clearEventsObjectsMap().addObjectsToEventsMap("Missile", gdjs.JeuCode.GDMissileObjects1).getEventsObjectsMap(), (( gdjs.JeuCode.GDToadObjects1.length === 0 ) ? 0 :gdjs.JeuCode.GDToadObjects1[0].getPointX("Missile")), (( gdjs.JeuCode.GDToadObjects1.length === 0 ) ? 0 :gdjs.JeuCode.GDToadObjects1[0].getPointY("Missile")), "");
}{for(var i = 0, len = gdjs.JeuCode.GDMissileObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDMissileObjects1[i].addForce(500, 0, 1);
}
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "Tir");
}}

}


{

gdjs.JeuCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));
gdjs.JeuCode.GDSuperMissileObjects1.length = 0;

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
gdjs.JeuCode.condition2IsTrue_0.val = false;
gdjs.JeuCode.condition3IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "LControl");
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 0.5, "Tir");
}if ( gdjs.JeuCode.condition1IsTrue_0.val ) {
{
gdjs.JeuCode.condition2IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(2)) == 1;
}if ( gdjs.JeuCode.condition2IsTrue_0.val ) {
{
gdjs.JeuCode.condition3IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}}
}
}
if (gdjs.JeuCode.condition3IsTrue_0.val) {
{gdjs.evtTools.object.createObjectOnScene(runtimeScene, context.clearEventsObjectsMap().addObjectsToEventsMap("SuperMissile", gdjs.JeuCode.GDSuperMissileObjects1).getEventsObjectsMap(), (( gdjs.JeuCode.GDToadObjects1.length === 0 ) ? 0 :gdjs.JeuCode.GDToadObjects1[0].getPointX("Missile")), (( gdjs.JeuCode.GDToadObjects1.length === 0 ) ? 0 :gdjs.JeuCode.GDToadObjects1[0].getPointY("Missile")), "");
}{for(var i = 0, len = gdjs.JeuCode.GDSuperMissileObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDSuperMissileObjects1[i].addForce(300, 0, 1);
}
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "Tir");
}}

}


{



}


{

gdjs.JeuCode.GDPVObjects1.createFrom(runtimeScene.getObjects("PV"));
gdjs.JeuCode.GDScoreObjects1.createFrom(runtimeScene.getObjects("Score"));

{for(var i = 0, len = gdjs.JeuCode.GDPVObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDPVObjects1[i].setString("Vies : "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(0)));
}
}{for(var i = 0, len = gdjs.JeuCode.GDScoreObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDScoreObjects1[i].setString("Score : "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(1)));
}
}
}


{

gdjs.JeuCode.GDGameOverObjects1.createFrom(runtimeScene.getObjects("GameOver"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.sceneJustBegins(runtimeScene);
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{runtimeScene.getVariables().getFromIndex(0).setNumber(5);
}{gdjs.evtTools.sound.playMusic(runtimeScene, "Song.ogg", false, 100, 1);
}{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].hide();
}
}}

}


{



}


{

gdjs.JeuCode.GDKoopaObjects1.createFrom(runtimeScene.getObjects("Koopa"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDKoopaObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDKoopaObjects1[i].addForce(-5, 0, 1);
}
}}

}


{

gdjs.JeuCode.GDKoopaObjects1.length = 0;

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 1.5, "SpawnKoopa");
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{gdjs.evtTools.object.createObjectOnScene(runtimeScene, context.clearEventsObjectsMap().addObjectsToEventsMap("Koopa", gdjs.JeuCode.GDKoopaObjects1).getEventsObjectsMap(), 1000, gdjs.random(768), "");
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "SpawnKoopa");
}}

}


{

gdjs.JeuCode.GDKoopaObjects1.createFrom(runtimeScene.getObjects("Koopa"));
gdjs.JeuCode.GDMissileObjects1.createFrom(runtimeScene.getObjects("Missile"));
gdjs.JeuCode.GDSuperMissileObjects1.createFrom(runtimeScene.getObjects("SuperMissile"));
gdjs.JeuCode.GDDeadKoopaObjects1.length = 0;

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Koopa", gdjs.JeuCode.GDKoopaObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Missile", gdjs.JeuCode.GDMissileObjects1).addObjectsToEventsMap("SuperMissile", gdjs.JeuCode.GDSuperMissileObjects1).getEventsObjectsMap(), false, runtimeScene);
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{gdjs.evtTools.object.createObjectOnScene(runtimeScene, context.clearEventsObjectsMap().addObjectsToEventsMap("DeadKoopa", gdjs.JeuCode.GDDeadKoopaObjects1).getEventsObjectsMap(), (( gdjs.JeuCode.GDKoopaObjects1.length === 0 ) ? 0 :gdjs.JeuCode.GDKoopaObjects1[0].getPointX("")), (( gdjs.JeuCode.GDKoopaObjects1.length === 0 ) ? 0 :gdjs.JeuCode.GDKoopaObjects1[0].getPointY("")), "");
}{for(var i = 0, len = gdjs.JeuCode.GDKoopaObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDKoopaObjects1[i].deleteFromScene(runtimeScene);
}
}{runtimeScene.getVariables().getFromIndex(1).add(100);
}{for(var i = 0, len = gdjs.JeuCode.GDMissileObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDMissileObjects1[i].deleteFromScene(runtimeScene);
}
for(var i = 0, len = gdjs.JeuCode.GDSuperMissileObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDSuperMissileObjects1[i].deleteFromScene(runtimeScene);
}
}{gdjs.evtTools.sound.playSound(runtimeScene, "toopakoopa_1.wav", false, 100, 1);
}}

}


{

gdjs.JeuCode.GDKoopaObjects1.createFrom(runtimeScene.getObjects("Koopa"));
gdjs.JeuCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Toad", gdjs.JeuCode.GDToadObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Koopa", gdjs.JeuCode.GDKoopaObjects1).getEventsObjectsMap(), false, runtimeScene);
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{runtimeScene.getVariables().getFromIndex(0).sub(1);
}{runtimeScene.getVariables().getFromIndex(1).sub(50);
}{for(var i = 0, len = gdjs.JeuCode.GDKoopaObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDKoopaObjects1[i].deleteFromScene(runtimeScene);
}
}}

}


{

gdjs.JeuCode.GDDeadKoopaObjects1.createFrom(runtimeScene.getObjects("DeadKoopa"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDDeadKoopaObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDDeadKoopaObjects1[i].addForce(0, 50, 1);
}
}}

}


{



}


{

gdjs.JeuCode.GDGameOverObjects1.createFrom(runtimeScene.getObjects("GameOver"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(0)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(1)) <= 0;
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].hide(false);
}
}{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].setString("Oh mais tu es vraiment nul ! Ton score final est de "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(1))+"points !");
}
}{runtimeScene.getVariables().getFromIndex(4).setNumber(1);
}}

}


{

gdjs.JeuCode.GDGameOverObjects1.createFrom(runtimeScene.getObjects("GameOver"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(0)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(1)) >= 1;
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].hide(false);
}
}{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].setString("Tu es pas trop nul... Ton score final est de "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(1))+"points !");
}
}{runtimeScene.getVariables().getFromIndex(4).setNumber(1);
}}

}


{

gdjs.JeuCode.GDGameOverObjects1.createFrom(runtimeScene.getObjects("GameOver"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(0)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(1)) >= 500;
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].hide(false);
}
}{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].setString("Tu es plutot fort... Ton score final est de "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(1))+"points !");
}
}{runtimeScene.getVariables().getFromIndex(4).setNumber(1);
}}

}


{

gdjs.JeuCode.GDGameOverObjects1.createFrom(runtimeScene.getObjects("GameOver"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(0)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(1)) >= 1000;
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].hide(false);
}
}{for(var i = 0, len = gdjs.JeuCode.GDGameOverObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDGameOverObjects1[i].setString("Bravo ! Ton score final est de "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().getFromIndex(1))+"points !");
}
}{runtimeScene.getVariables().getFromIndex(4).setNumber(1);
}}

}


{



}


{

gdjs.JeuCode.GDBlocObjects1.createFrom(runtimeScene.getObjects("Bloc"));
gdjs.JeuCode.GDMissileObjects1.createFrom(runtimeScene.getObjects("Missile"));
gdjs.JeuCode.GDSuperMissileObjects1.createFrom(runtimeScene.getObjects("SuperMissile"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
gdjs.JeuCode.condition2IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Missile", gdjs.JeuCode.GDMissileObjects1).addObjectsToEventsMap("SuperMissile", gdjs.JeuCode.GDSuperMissileObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Bloc", gdjs.JeuCode.GDBlocObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition1IsTrue_0.val ) {
{
gdjs.JeuCode.condition2IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(2)) == 0;
}}
}
if (gdjs.JeuCode.condition2IsTrue_0.val) {
{runtimeScene.getVariables().getFromIndex(2).setNumber(1);
}{for(var i = 0, len = gdjs.JeuCode.GDBlocObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDBlocObjects1[i].deleteFromScene(runtimeScene);
}
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "Missile2");
}}

}


{

gdjs.JeuCode.GDBlocObjects1.createFrom(runtimeScene.getObjects("Bloc"));
gdjs.JeuCode.GDMissileObjects1.createFrom(runtimeScene.getObjects("Missile"));
gdjs.JeuCode.GDSuperMissileObjects1.createFrom(runtimeScene.getObjects("SuperMissile"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Missile", gdjs.JeuCode.GDMissileObjects1).addObjectsToEventsMap("SuperMissile", gdjs.JeuCode.GDSuperMissileObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Bloc", gdjs.JeuCode.GDBlocObjects1).getEventsObjectsMap(), false, runtimeScene);
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDBlocObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDBlocObjects1[i].deleteFromScene(runtimeScene);
}
}}

}


{

gdjs.JeuCode.GDBlocObjects1.length = 0;

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 4, "Blocs");
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{gdjs.evtTools.object.createObjectOnScene(runtimeScene, context.clearEventsObjectsMap().addObjectsToEventsMap("Bloc", gdjs.JeuCode.GDBlocObjects1).getEventsObjectsMap(), 1000, gdjs.random(768), "");
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "Blocs");
}}

}


{

gdjs.JeuCode.GDBlocObjects1.createFrom(runtimeScene.getObjects("Bloc"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDBlocObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDBlocObjects1[i].addForce(-3, 0, 1);
}
}}

}


{


gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
gdjs.JeuCode.condition2IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(2)) == 1;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition1IsTrue_0.val ) {
{
gdjs.JeuCode.condition2IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 20, "Missile2");
}}
}
if (gdjs.JeuCode.condition2IsTrue_0.val) {
{runtimeScene.getVariables().getFromIndex(2).setNumber(0);
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "");
}}

}


{

gdjs.JeuCode.GDKoopaObjects1.createFrom(runtimeScene.getObjects("Koopa"));

{for(var i = 0, len = gdjs.JeuCode.GDKoopaObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDKoopaObjects1[i].addForce(-5, 0, 1);
}
}
}


{

gdjs.JeuCode.GDKoopaObjects1.length = 0;

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 1.5, "SpawnKoopa");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{gdjs.evtTools.object.createObjectOnScene(runtimeScene, context.clearEventsObjectsMap().addObjectsToEventsMap("Koopa", gdjs.JeuCode.GDKoopaObjects1).getEventsObjectsMap(), 1000, gdjs.random(768), "");
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "SpawnKoopa");
}}

}


{



}


{

gdjs.JeuCode.GDNuageObjects1.length = 0;

gdjs.JeuCode.condition0IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.timerElapsedTime(runtimeScene, 0.5, "SpawnNuage");
}if (gdjs.JeuCode.condition0IsTrue_0.val) {
{gdjs.evtTools.object.createObjectOnScene(runtimeScene, context.clearEventsObjectsMap().addObjectsToEventsMap("Nuage", gdjs.JeuCode.GDNuageObjects1).getEventsObjectsMap(), 1000, gdjs.random(768), "");
}{gdjs.evtTools.runtimeScene.resetTimer(runtimeScene, "SpawnNuage");
}}

}


{

gdjs.JeuCode.GDNuageObjects1.createFrom(runtimeScene.getObjects("Nuage"));

{for(var i = 0, len = gdjs.JeuCode.GDNuageObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDNuageObjects1[i].addForce(-10, 0, 1);
}
}
}


{



}


{

gdjs.JeuCode.GDTempsObjects1.createFrom(runtimeScene.getObjects("Temps"));

{runtimeScene.getVariables().getFromIndex(3).add(gdjs.evtTools.runtimeScene.getElapsedTimeInSeconds(runtimeScene));
}{for(var i = 0, len = gdjs.JeuCode.GDTempsObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDTempsObjects1[i].setString("Chrono : "+gdjs.evtTools.common.toString(Math.floor(gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(3))*100)/100));
}
}
}


{



}


{


gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "Return");
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(4)) == 1;
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.changeScene(runtimeScene, "Menu");
}{runtimeScene.getVariables().getFromIndex(4).setNumber(0);
}}

}


{



}


{


gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 0;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "p");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{runtimeScene.getVariables().getFromIndex(5).setNumber(1);
}}

}


{


gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().getFromIndex(5)) == 1;
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
gdjs.JeuCode.condition1IsTrue_0.val = gdjs.evtTools.input.isKeyPressed(runtimeScene, "p");
}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{runtimeScene.getVariables().getFromIndex(5).setNumber(0);
}}

}


{



}


{

gdjs.JeuCode.GDBarre1Objects1.createFrom(runtimeScene.getObjects("Barre1"));
gdjs.JeuCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));

gdjs.JeuCode.condition0IsTrue_0.val = false;
gdjs.JeuCode.condition1IsTrue_0.val = false;
{
gdjs.JeuCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Toad", gdjs.JeuCode.GDToadObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Barre1", gdjs.JeuCode.GDBarre1Objects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.JeuCode.condition0IsTrue_0.val ) {
{
for(var i = 0, k = 0, l = gdjs.JeuCode.GDToadObjects1.length;i<l;++i) {
    if ( !(gdjs.JeuCode.GDToadObjects1[i].averageForceAngleIs(270, 0)) ) {
        gdjs.JeuCode.condition1IsTrue_0.val = true;
        gdjs.JeuCode.GDToadObjects1[k] = gdjs.JeuCode.GDToadObjects1[i];
        ++k;
    }
}
gdjs.JeuCode.GDToadObjects1.length = k;}}
if (gdjs.JeuCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.JeuCode.GDToadObjects1.length ;i < len;++i) {
    gdjs.JeuCode.GDToadObjects1[i].clearForces();
}
}}

}

return;
}
gdjs['JeuCode']= gdjs.JeuCode;