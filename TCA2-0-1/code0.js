gdjs.TitleScreenCode = {};


gdjs.TitleScreenCode.GDFondObjects1= [];
gdjs.TitleScreenCode.GDJouerObjects1= [];
gdjs.TitleScreenCode.GDViseurObjects1= [];
gdjs.TitleScreenCode.GDTextObjects1= [];
gdjs.TitleScreenCode.GDSinscrireObjects1= [];
gdjs.TitleScreenCode.GDNextObjects1= [];
gdjs.TitleScreenCode.GDBoutiqueObjects1= [];
gdjs.TitleScreenCode.GDRestartObjects1= [];

gdjs.TitleScreenCode.conditionTrue_0 = {val:false};
gdjs.TitleScreenCode.condition0IsTrue_0 = {val:false};
gdjs.TitleScreenCode.condition1IsTrue_0 = {val:false};
gdjs.TitleScreenCode.condition2IsTrue_0 = {val:false};
gdjs.TitleScreenCode.condition3IsTrue_0 = {val:false};
gdjs.TitleScreenCode.conditionTrue_1 = {val:false};
gdjs.TitleScreenCode.condition0IsTrue_1 = {val:false};
gdjs.TitleScreenCode.condition1IsTrue_1 = {val:false};
gdjs.TitleScreenCode.condition2IsTrue_1 = {val:false};
gdjs.TitleScreenCode.condition3IsTrue_1 = {val:false};

gdjs.TitleScreenCode.func = function(runtimeScene, context) {
context.startNewFrame();
gdjs.TitleScreenCode.GDFondObjects1.length = 0;
gdjs.TitleScreenCode.GDJouerObjects1.length = 0;
gdjs.TitleScreenCode.GDViseurObjects1.length = 0;
gdjs.TitleScreenCode.GDTextObjects1.length = 0;
gdjs.TitleScreenCode.GDSinscrireObjects1.length = 0;
gdjs.TitleScreenCode.GDNextObjects1.length = 0;
gdjs.TitleScreenCode.GDBoutiqueObjects1.length = 0;
gdjs.TitleScreenCode.GDRestartObjects1.length = 0;


{

gdjs.TitleScreenCode.GDJouerObjects1.createFrom(runtimeScene.getObjects("Jouer"));
gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
gdjs.TitleScreenCode.condition1IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.TitleScreenCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Jouer", gdjs.TitleScreenCode.GDJouerObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.TitleScreenCode.condition0IsTrue_0.val ) {
{
gdjs.TitleScreenCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}}
if (gdjs.TitleScreenCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Roster", false);
}{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}}

}


{

gdjs.TitleScreenCode.GDBoutiqueObjects1.createFrom(runtimeScene.getObjects("Boutique"));
gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
gdjs.TitleScreenCode.condition1IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.TitleScreenCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Boutique", gdjs.TitleScreenCode.GDBoutiqueObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.TitleScreenCode.condition0IsTrue_0.val ) {
{
gdjs.TitleScreenCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}}
if (gdjs.TitleScreenCode.condition1IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Boutique", false);
}}

}


{

gdjs.TitleScreenCode.GDSinscrireObjects1.createFrom(runtimeScene.getObjects("Sinscrire"));
gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
gdjs.TitleScreenCode.condition1IsTrue_0.val = false;
gdjs.TitleScreenCode.condition2IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.TitleScreenCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Sinscrire", gdjs.TitleScreenCode.GDSinscrireObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.TitleScreenCode.condition0IsTrue_0.val ) {
{
gdjs.TitleScreenCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.TitleScreenCode.condition1IsTrue_0.val ) {
{
{gdjs.TitleScreenCode.conditionTrue_1 = gdjs.TitleScreenCode.condition2IsTrue_0;
gdjs.TitleScreenCode.conditionTrue_1.val = context.triggerOnce(469417652);
}
}}
}
if (gdjs.TitleScreenCode.condition2IsTrue_0.val) {
{gdjs.evtTools.window.openURL("http://www.planete-toad.fr/inscription.html");
}}

}


{

gdjs.TitleScreenCode.GDRestartObjects1.createFrom(runtimeScene.getObjects("Restart"));
gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
gdjs.TitleScreenCode.condition1IsTrue_0.val = false;
gdjs.TitleScreenCode.condition2IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.TitleScreenCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Restart", gdjs.TitleScreenCode.GDRestartObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.TitleScreenCode.condition0IsTrue_0.val ) {
{
gdjs.TitleScreenCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Right");
}if ( gdjs.TitleScreenCode.condition1IsTrue_0.val ) {
{
{gdjs.TitleScreenCode.conditionTrue_1 = gdjs.TitleScreenCode.condition2IsTrue_0;
gdjs.TitleScreenCode.conditionTrue_1.val = context.triggerOnce(469417940);
}
}}
}
if (gdjs.TitleScreenCode.condition2IsTrue_0.val) {
{gdjs.evtTools.storage.clearJSONFile("Score.txt");
}{gdjs.evtTools.storage.clearJSONFile("Items.txt");
}{gdjs.evtTools.storage.clearJSONFile("Pieces.txt");
}{gdjs.evtTools.sound.playSound(runtimeScene, "boum.wav", false, 100, 1);
}}

}


{

gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

{for(var i = 0, len = gdjs.TitleScreenCode.GDViseurObjects1.length ;i < len;++i) {
    gdjs.TitleScreenCode.GDViseurObjects1[i].setPosition(gdjs.evtTools.input.getMouseX(runtimeScene, "", 0),gdjs.evtTools.input.getMouseY(runtimeScene, "", 0));
}
}{gdjs.evtTools.input.hideCursor(runtimeScene);
}
}


{



}


{

gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("Tirer")) == 0;
}if (gdjs.TitleScreenCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.TitleScreenCode.GDViseurObjects1.length ;i < len;++i) {
    gdjs.TitleScreenCode.GDViseurObjects1[i].setAnimation(1);
}
}}

}


{

gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("Tirer")) == 1;
}if (gdjs.TitleScreenCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.TitleScreenCode.GDViseurObjects1.length ;i < len;++i) {
    gdjs.TitleScreenCode.GDViseurObjects1[i].setAnimation(0);
}
}}

}


{


{gdjs.evtTools.window.setFullScreen(runtimeScene, false, true);
}
}


{

gdjs.TitleScreenCode.GDNextObjects1.createFrom(runtimeScene.getObjects("Next"));
gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.TitleScreenCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Next", gdjs.TitleScreenCode.GDNextObjects1).getEventsObjectsMap(), true, runtimeScene);
}if (gdjs.TitleScreenCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.TitleScreenCode.GDNextObjects1.length ;i < len;++i) {
    gdjs.TitleScreenCode.GDNextObjects1[i].setOpacity(100);
}
}}

}


{

gdjs.TitleScreenCode.GDNextObjects1.createFrom(runtimeScene.getObjects("Next"));
gdjs.TitleScreenCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.TitleScreenCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Next", gdjs.TitleScreenCode.GDNextObjects1).getEventsObjectsMap(), false, runtimeScene);
}if (gdjs.TitleScreenCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.TitleScreenCode.GDNextObjects1.length ;i < len;++i) {
    gdjs.TitleScreenCode.GDNextObjects1[i].setOpacity(255);
}
}}

}


{


gdjs.TitleScreenCode.condition0IsTrue_0.val = false;
{
gdjs.TitleScreenCode.condition0IsTrue_0.val = gdjs.evtTools.runtimeScene.sceneJustBegins(runtimeScene);
}if (gdjs.TitleScreenCode.condition0IsTrue_0.val) {
{gdjs.evtTools.sound.playMusicOnChannel(runtimeScene, "Menu.ogg", 1, true, 100, 1);
}}

}

return;
}
gdjs['TitleScreenCode']= gdjs.TitleScreenCode;
