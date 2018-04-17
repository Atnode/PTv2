gdjs.RosterCode = {};


gdjs.RosterCode.GDFondObjects1= [];
gdjs.RosterCode.GDToadObjects1= [];
gdjs.RosterCode.GDMarioObjects1= [];
gdjs.RosterCode.GDLockedObjects1= [];
gdjs.RosterCode.GDViseurObjects1= [];
gdjs.RosterCode.GDLuigiObjects1= [];
gdjs.RosterCode.GDChooseObjects1= [];
gdjs.RosterCode.GDPeachObjects1= [];
gdjs.RosterCode.GDYoshiObjects1= [];
gdjs.RosterCode.GDDKJRObjects1= [];
gdjs.RosterCode.GDBowserObjects1= [];
gdjs.RosterCode.GDWarioObjects1= [];

gdjs.RosterCode.conditionTrue_0 = {val:false};
gdjs.RosterCode.condition0IsTrue_0 = {val:false};
gdjs.RosterCode.condition1IsTrue_0 = {val:false};
gdjs.RosterCode.condition2IsTrue_0 = {val:false};
gdjs.RosterCode.conditionTrue_1 = {val:false};
gdjs.RosterCode.condition0IsTrue_1 = {val:false};
gdjs.RosterCode.condition1IsTrue_1 = {val:false};
gdjs.RosterCode.condition2IsTrue_1 = {val:false};

gdjs.RosterCode.func = function(runtimeScene, context) {
context.startNewFrame();
gdjs.RosterCode.GDFondObjects1.length = 0;
gdjs.RosterCode.GDToadObjects1.length = 0;
gdjs.RosterCode.GDMarioObjects1.length = 0;
gdjs.RosterCode.GDLockedObjects1.length = 0;
gdjs.RosterCode.GDViseurObjects1.length = 0;
gdjs.RosterCode.GDLuigiObjects1.length = 0;
gdjs.RosterCode.GDChooseObjects1.length = 0;
gdjs.RosterCode.GDPeachObjects1.length = 0;
gdjs.RosterCode.GDYoshiObjects1.length = 0;
gdjs.RosterCode.GDDKJRObjects1.length = 0;
gdjs.RosterCode.GDBowserObjects1.length = 0;
gdjs.RosterCode.GDWarioObjects1.length = 0;


{

gdjs.RosterCode.GDToadObjects1.createFrom(runtimeScene.getObjects("Toad"));
gdjs.RosterCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.RosterCode.condition0IsTrue_0.val = false;
gdjs.RosterCode.condition1IsTrue_0.val = false;
{
gdjs.RosterCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.RosterCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Toad", gdjs.RosterCode.GDToadObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.RosterCode.condition0IsTrue_0.val ) {
{
gdjs.RosterCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}}
if (gdjs.RosterCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Stage", false);
}{runtimeScene.getGame().getVariables().get("Roster").setNumber(0);
}{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}}

}


{

gdjs.RosterCode.GDMarioObjects1.createFrom(runtimeScene.getObjects("Mario"));
gdjs.RosterCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.RosterCode.condition0IsTrue_0.val = false;
gdjs.RosterCode.condition1IsTrue_0.val = false;
{
gdjs.RosterCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.RosterCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Mario", gdjs.RosterCode.GDMarioObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.RosterCode.condition0IsTrue_0.val ) {
{
gdjs.RosterCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}}
if (gdjs.RosterCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Stage", false);
}{runtimeScene.getGame().getVariables().get("Roster").setNumber(1);
}{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}}

}


{

gdjs.RosterCode.GDLuigiObjects1.createFrom(runtimeScene.getObjects("Luigi"));
gdjs.RosterCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.RosterCode.condition0IsTrue_0.val = false;
gdjs.RosterCode.condition1IsTrue_0.val = false;
{
gdjs.RosterCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.RosterCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Luigi", gdjs.RosterCode.GDLuigiObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.RosterCode.condition0IsTrue_0.val ) {
{
gdjs.RosterCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}}
if (gdjs.RosterCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Stage", false);
}{runtimeScene.getGame().getVariables().get("Roster").setNumber(2);
}{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}}

}


{

gdjs.RosterCode.GDPeachObjects1.createFrom(runtimeScene.getObjects("Peach"));
gdjs.RosterCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.RosterCode.condition0IsTrue_0.val = false;
gdjs.RosterCode.condition1IsTrue_0.val = false;
{
gdjs.RosterCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.RosterCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Peach", gdjs.RosterCode.GDPeachObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.RosterCode.condition0IsTrue_0.val ) {
{
gdjs.RosterCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}}
if (gdjs.RosterCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Stage", false);
}{runtimeScene.getGame().getVariables().get("Roster").setNumber(3);
}{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}}

}


{

gdjs.RosterCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));
gdjs.RosterCode.GDYoshiObjects1.createFrom(runtimeScene.getObjects("Yoshi"));

gdjs.RosterCode.condition0IsTrue_0.val = false;
gdjs.RosterCode.condition1IsTrue_0.val = false;
{
gdjs.RosterCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.RosterCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Yoshi", gdjs.RosterCode.GDYoshiObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.RosterCode.condition0IsTrue_0.val ) {
{
gdjs.RosterCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}}
if (gdjs.RosterCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Stage", false);
}{runtimeScene.getGame().getVariables().get("Roster").setNumber(4);
}{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}}

}


{


gdjs.RosterCode.condition0IsTrue_0.val = false;
{
{gdjs.RosterCode.conditionTrue_1 = gdjs.RosterCode.condition0IsTrue_0;
gdjs.RosterCode.conditionTrue_1.val = context.triggerOnce(469917172);
}
}if (gdjs.RosterCode.condition0IsTrue_0.val) {
{gdjs.evtTools.sound.playMusicOnChannel(runtimeScene, "choose.ogg", 1, true, 100, 1);
}}

}


{

gdjs.RosterCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

{for(var i = 0, len = gdjs.RosterCode.GDViseurObjects1.length ;i < len;++i) {
    gdjs.RosterCode.GDViseurObjects1[i].setPosition(gdjs.evtTools.input.getMouseX(runtimeScene, "", 0),gdjs.evtTools.input.getMouseY(runtimeScene, "", 0));
}
}{gdjs.evtTools.input.hideCursor(runtimeScene);
}
}


{


gdjs.RosterCode.condition0IsTrue_0.val = false;
{
gdjs.RosterCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.sceneJustBegins(runtimeScene);
}if (gdjs.RosterCode.condition0IsTrue_0.val) {
{gdjs.evtTools.sound.playSound(runtimeScene, "choose.wav", false, 100, 1);
}}

}

return;
}
gdjs['RosterCode']= gdjs.RosterCode;
