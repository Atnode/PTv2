gdjs.BoutiqueCode = {};


gdjs.BoutiqueCode.GDViseurObjects1= [];
gdjs.BoutiqueCode.GDNouvelObjetObjects1= [];
gdjs.BoutiqueCode.GDBoutiqueObjects1= [];
gdjs.BoutiqueCode.GDCle1Objects1= [];
gdjs.BoutiqueCode.GDDescCle1Objects1= [];
gdjs.BoutiqueCode.GDPieceObjects1= [];
gdjs.BoutiqueCode.GDCoinObjects1= [];
gdjs.BoutiqueCode.GDCle2Objects1= [];
gdjs.BoutiqueCode.GDDescCle2Objects1= [];
gdjs.BoutiqueCode.GDBackObjects1= [];

gdjs.BoutiqueCode.conditionTrue_0 = {val:false};
gdjs.BoutiqueCode.condition0IsTrue_0 = {val:false};
gdjs.BoutiqueCode.condition1IsTrue_0 = {val:false};
gdjs.BoutiqueCode.condition2IsTrue_0 = {val:false};
gdjs.BoutiqueCode.condition3IsTrue_0 = {val:false};
gdjs.BoutiqueCode.condition4IsTrue_0 = {val:false};
gdjs.BoutiqueCode.condition5IsTrue_0 = {val:false};
gdjs.BoutiqueCode.conditionTrue_1 = {val:false};
gdjs.BoutiqueCode.condition0IsTrue_1 = {val:false};
gdjs.BoutiqueCode.condition1IsTrue_1 = {val:false};
gdjs.BoutiqueCode.condition2IsTrue_1 = {val:false};
gdjs.BoutiqueCode.condition3IsTrue_1 = {val:false};
gdjs.BoutiqueCode.condition4IsTrue_1 = {val:false};
gdjs.BoutiqueCode.condition5IsTrue_1 = {val:false};

gdjs.BoutiqueCode.func = function(runtimeScene, context) {
context.startNewFrame();
gdjs.BoutiqueCode.GDViseurObjects1.length = 0;
gdjs.BoutiqueCode.GDNouvelObjetObjects1.length = 0;
gdjs.BoutiqueCode.GDBoutiqueObjects1.length = 0;
gdjs.BoutiqueCode.GDCle1Objects1.length = 0;
gdjs.BoutiqueCode.GDDescCle1Objects1.length = 0;
gdjs.BoutiqueCode.GDPieceObjects1.length = 0;
gdjs.BoutiqueCode.GDCoinObjects1.length = 0;
gdjs.BoutiqueCode.GDCle2Objects1.length = 0;
gdjs.BoutiqueCode.GDDescCle2Objects1.length = 0;
gdjs.BoutiqueCode.GDBackObjects1.length = 0;


{

gdjs.BoutiqueCode.GDPieceObjects1.createFrom(runtimeScene.getObjects("Piece"));

{gdjs.evtTools.storage.readNumberFromJSONFile("Pieces.txt", "Pieces", runtimeScene, runtimeScene.getVariables().get("Pieces"));
}{for(var i = 0, len = gdjs.BoutiqueCode.GDPieceObjects1.length ;i < len;++i) {
    gdjs.BoutiqueCode.GDPieceObjects1[i].setString(gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().get("Pieces")));
}
}
}


{

gdjs.BoutiqueCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

{for(var i = 0, len = gdjs.BoutiqueCode.GDViseurObjects1.length ;i < len;++i) {
    gdjs.BoutiqueCode.GDViseurObjects1[i].setPosition(gdjs.evtTools.input.getMouseX(runtimeScene, "", 0),gdjs.evtTools.input.getMouseY(runtimeScene, "", 0));
}
}{gdjs.evtTools.input.hideCursor(runtimeScene);
}
}


{



}


{

gdjs.BoutiqueCode.GDCle1Objects1.createFrom(runtimeScene.getObjects("Cle1"));
gdjs.BoutiqueCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.BoutiqueCode.condition0IsTrue_0.val = false;
gdjs.BoutiqueCode.condition1IsTrue_0.val = false;
gdjs.BoutiqueCode.condition2IsTrue_0.val = false;
gdjs.BoutiqueCode.condition3IsTrue_0.val = false;
gdjs.BoutiqueCode.condition4IsTrue_0.val = false;
{
gdjs.BoutiqueCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.BoutiqueCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Cle1", gdjs.BoutiqueCode.GDCle1Objects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.BoutiqueCode.condition0IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.BoutiqueCode.condition1IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition2IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle1")) != 1;
}if ( gdjs.BoutiqueCode.condition2IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition3IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("Pieces")) >= 500;
}if ( gdjs.BoutiqueCode.condition3IsTrue_0.val ) {
{
{gdjs.BoutiqueCode.conditionTrue_1 = gdjs.BoutiqueCode.condition4IsTrue_0;
gdjs.BoutiqueCode.conditionTrue_1.val = context.triggerOnce(469924156);
}
}}
}
}
}
if (gdjs.BoutiqueCode.condition4IsTrue_0.val) {
{gdjs.evtTools.sound.playMusic(runtimeScene, "stomp.ogg", false, 100, 1);
}{gdjs.evtTools.storage.writeNumberInJSONFile("Items.txt", "Cle1", 1);
}{gdjs.evtTools.storage.writeNumberInJSONFile("Pieces.txt", "Pieces", gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("Pieces"))-500);
}}

}


{

gdjs.BoutiqueCode.GDCle2Objects1.createFrom(runtimeScene.getObjects("Cle2"));
gdjs.BoutiqueCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.BoutiqueCode.condition0IsTrue_0.val = false;
gdjs.BoutiqueCode.condition1IsTrue_0.val = false;
gdjs.BoutiqueCode.condition2IsTrue_0.val = false;
gdjs.BoutiqueCode.condition3IsTrue_0.val = false;
gdjs.BoutiqueCode.condition4IsTrue_0.val = false;
{
gdjs.BoutiqueCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.BoutiqueCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Cle2", gdjs.BoutiqueCode.GDCle2Objects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.BoutiqueCode.condition0IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.BoutiqueCode.condition1IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition2IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle2")) != 1;
}if ( gdjs.BoutiqueCode.condition2IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition3IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("Pieces")) >= 2000;
}if ( gdjs.BoutiqueCode.condition3IsTrue_0.val ) {
{
{gdjs.BoutiqueCode.conditionTrue_1 = gdjs.BoutiqueCode.condition4IsTrue_0;
gdjs.BoutiqueCode.conditionTrue_1.val = context.triggerOnce(469924804);
}
}}
}
}
}
if (gdjs.BoutiqueCode.condition4IsTrue_0.val) {
{gdjs.evtTools.sound.playMusic(runtimeScene, "stomp.ogg", false, 100, 1);
}{gdjs.evtTools.storage.writeNumberInJSONFile("Items.txt", "Cle2", 1);
}{gdjs.evtTools.storage.writeNumberInJSONFile("Pieces.txt", "Pieces", gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("Pieces"))-2000);
}}

}


{

gdjs.BoutiqueCode.GDBackObjects1.createFrom(runtimeScene.getObjects("Back"));
gdjs.BoutiqueCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.BoutiqueCode.condition0IsTrue_0.val = false;
gdjs.BoutiqueCode.condition1IsTrue_0.val = false;
gdjs.BoutiqueCode.condition2IsTrue_0.val = false;
{
gdjs.BoutiqueCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.BoutiqueCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Back", gdjs.BoutiqueCode.GDBackObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.BoutiqueCode.condition0IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.BoutiqueCode.condition1IsTrue_0.val ) {
{
{gdjs.BoutiqueCode.conditionTrue_1 = gdjs.BoutiqueCode.condition2IsTrue_0;
gdjs.BoutiqueCode.conditionTrue_1.val = context.triggerOnce(469925380);
}
}}
}
if (gdjs.BoutiqueCode.condition2IsTrue_0.val) {
{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "TitleScreen", false);
}}

}


{



}


{


{gdjs.evtTools.storage.readNumberFromJSONFile("Items.txt", "Cle1", runtimeScene, runtimeScene.getVariables().get("BuyCle1"));
}{gdjs.evtTools.storage.unloadJSONFile("Items.txt");
}
}


{


{gdjs.evtTools.storage.readNumberFromJSONFile("Items.txt", "Cle2", runtimeScene, runtimeScene.getVariables().get("BuyCle2"));
}{gdjs.evtTools.storage.unloadJSONFile("Items.txt");
}
}


{



}


{

gdjs.BoutiqueCode.GDDescCle2Objects1.createFrom(runtimeScene.getObjects("DescCle2"));

gdjs.BoutiqueCode.condition0IsTrue_0.val = false;
gdjs.BoutiqueCode.condition1IsTrue_0.val = false;
{
gdjs.BoutiqueCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle2")) == 1;
}if ( gdjs.BoutiqueCode.condition0IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 2;
}}
if (gdjs.BoutiqueCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.BoutiqueCode.GDDescCle2Objects1.length ;i < len;++i) {
    gdjs.BoutiqueCode.GDDescCle2Objects1[i].setColor("0;0;0");
}
}}

}


{

gdjs.BoutiqueCode.GDDescCle1Objects1.createFrom(runtimeScene.getObjects("DescCle1"));

gdjs.BoutiqueCode.condition0IsTrue_0.val = false;
gdjs.BoutiqueCode.condition1IsTrue_0.val = false;
{
gdjs.BoutiqueCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle1")) == 1;
}if ( gdjs.BoutiqueCode.condition0IsTrue_0.val ) {
{
gdjs.BoutiqueCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 1;
}}
if (gdjs.BoutiqueCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.BoutiqueCode.GDDescCle1Objects1.length ;i < len;++i) {
    gdjs.BoutiqueCode.GDDescCle1Objects1[i].setColor("0;0;0");
}
}}

}

return;
}
gdjs['BoutiqueCode']= gdjs.BoutiqueCode;
