gdjs.StageCode = {};


gdjs.StageCode.GDViseurObjects1= [];
gdjs.StageCode.GDNouvelObjetObjects1= [];
gdjs.StageCode.GDLeftObjects1= [];
gdjs.StageCode.GDRightObjects1= [];
gdjs.StageCode.GDChooseLevelObjects1= [];
gdjs.StageCode.GDNomDuStageObjects1= [];
gdjs.StageCode.GDJouerObjects1= [];
gdjs.StageCode.GDMeilleursScoresObjects1= [];

gdjs.StageCode.conditionTrue_0 = {val:false};
gdjs.StageCode.condition0IsTrue_0 = {val:false};
gdjs.StageCode.condition1IsTrue_0 = {val:false};
gdjs.StageCode.condition2IsTrue_0 = {val:false};
gdjs.StageCode.condition3IsTrue_0 = {val:false};
gdjs.StageCode.condition4IsTrue_0 = {val:false};
gdjs.StageCode.condition5IsTrue_0 = {val:false};
gdjs.StageCode.conditionTrue_1 = {val:false};
gdjs.StageCode.condition0IsTrue_1 = {val:false};
gdjs.StageCode.condition1IsTrue_1 = {val:false};
gdjs.StageCode.condition2IsTrue_1 = {val:false};
gdjs.StageCode.condition3IsTrue_1 = {val:false};
gdjs.StageCode.condition4IsTrue_1 = {val:false};
gdjs.StageCode.condition5IsTrue_1 = {val:false};

gdjs.StageCode.func = function(runtimeScene, context) {
context.startNewFrame();
gdjs.StageCode.GDViseurObjects1.length = 0;
gdjs.StageCode.GDNouvelObjetObjects1.length = 0;
gdjs.StageCode.GDLeftObjects1.length = 0;
gdjs.StageCode.GDRightObjects1.length = 0;
gdjs.StageCode.GDChooseLevelObjects1.length = 0;
gdjs.StageCode.GDNomDuStageObjects1.length = 0;
gdjs.StageCode.GDJouerObjects1.length = 0;
gdjs.StageCode.GDMeilleursScoresObjects1.length = 0;


{

gdjs.StageCode.GDNomDuStageObjects1.createFrom(runtimeScene.getObjects("NomDuStage"));
gdjs.StageCode.GDNouvelObjetObjects1.createFrom(runtimeScene.getObjects("NouvelObjet"));

gdjs.StageCode.condition0IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 0;
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.StageCode.GDNouvelObjetObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNouvelObjetObjects1[i].setAnimation(0);
}
}{for(var i = 0, len = gdjs.StageCode.GDNomDuStageObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNomDuStageObjects1[i].setString("Prairie des Goombas");
}
}}

}


{

gdjs.StageCode.GDNomDuStageObjects1.createFrom(runtimeScene.getObjects("NomDuStage"));
gdjs.StageCode.GDNouvelObjetObjects1.createFrom(runtimeScene.getObjects("NouvelObjet"));

gdjs.StageCode.condition0IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 1;
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.StageCode.GDNouvelObjetObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNouvelObjetObjects1[i].setAnimation(1);
}
}{for(var i = 0, len = gdjs.StageCode.GDNomDuStageObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNomDuStageObjects1[i].setString("Caverne humide");
}
}}

}


{

gdjs.StageCode.GDNomDuStageObjects1.createFrom(runtimeScene.getObjects("NomDuStage"));
gdjs.StageCode.GDNouvelObjetObjects1.createFrom(runtimeScene.getObjects("NouvelObjet"));

gdjs.StageCode.condition0IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 2;
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.StageCode.GDNouvelObjetObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNouvelObjetObjects1[i].setAnimation(2);
}
}{for(var i = 0, len = gdjs.StageCode.GDNomDuStageObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNomDuStageObjects1[i].setString("Sommet Champignon");
}
}}

}


{

gdjs.StageCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

{for(var i = 0, len = gdjs.StageCode.GDViseurObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDViseurObjects1[i].setPosition(gdjs.evtTools.input.getMouseX(runtimeScene, "", 0),gdjs.evtTools.input.getMouseY(runtimeScene, "", 0));
}
}{gdjs.evtTools.input.hideCursor(runtimeScene);
}
}


{

gdjs.StageCode.GDLeftObjects1.createFrom(runtimeScene.getObjects("Left"));
gdjs.StageCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.StageCode.condition0IsTrue_0.val = false;
gdjs.StageCode.condition1IsTrue_0.val = false;
gdjs.StageCode.condition2IsTrue_0.val = false;
gdjs.StageCode.condition3IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.StageCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Left", gdjs.StageCode.GDLeftObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.StageCode.condition0IsTrue_0.val ) {
{
gdjs.StageCode.condition1IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.StageCode.condition1IsTrue_0.val ) {
{
gdjs.StageCode.condition2IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) != 0;
}if ( gdjs.StageCode.condition2IsTrue_0.val ) {
{
{gdjs.StageCode.conditionTrue_1 = gdjs.StageCode.condition3IsTrue_0;
gdjs.StageCode.conditionTrue_1.val = context.triggerOnce(469919188);
}
}}
}
}
if (gdjs.StageCode.condition3IsTrue_0.val) {
{runtimeScene.getGame().getVariables().get("Monde").sub(1);
}}

}


{

gdjs.StageCode.GDRightObjects1.createFrom(runtimeScene.getObjects("Right"));
gdjs.StageCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.StageCode.condition0IsTrue_0.val = false;
gdjs.StageCode.condition1IsTrue_0.val = false;
gdjs.StageCode.condition2IsTrue_0.val = false;
gdjs.StageCode.condition3IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.StageCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Right", gdjs.StageCode.GDRightObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.StageCode.condition0IsTrue_0.val ) {
{
gdjs.StageCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) != 2;
}if ( gdjs.StageCode.condition1IsTrue_0.val ) {
{
gdjs.StageCode.condition2IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.StageCode.condition2IsTrue_0.val ) {
{
{gdjs.StageCode.conditionTrue_1 = gdjs.StageCode.condition3IsTrue_0;
gdjs.StageCode.conditionTrue_1.val = context.triggerOnce(469919620);
}
}}
}
}
if (gdjs.StageCode.condition3IsTrue_0.val) {
{runtimeScene.getGame().getVariables().get("Monde").add(1);
}}

}


{



}


{

gdjs.StageCode.GDJouerObjects1.createFrom(runtimeScene.getObjects("Jouer"));
gdjs.StageCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.StageCode.condition0IsTrue_0.val = false;
gdjs.StageCode.condition1IsTrue_0.val = false;
gdjs.StageCode.condition2IsTrue_0.val = false;
gdjs.StageCode.condition3IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 0;
}if ( gdjs.StageCode.condition0IsTrue_0.val ) {
{
gdjs.StageCode.condition1IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.StageCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Jouer", gdjs.StageCode.GDJouerObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.StageCode.condition1IsTrue_0.val ) {
{
gdjs.StageCode.condition2IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.StageCode.condition2IsTrue_0.val ) {
{
{gdjs.StageCode.conditionTrue_1 = gdjs.StageCode.condition3IsTrue_0;
gdjs.StageCode.conditionTrue_1.val = context.triggerOnce(469919980);
}
}}
}
}
if (gdjs.StageCode.condition3IsTrue_0.val) {
{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Jeej", false);
}}

}


{

gdjs.StageCode.GDJouerObjects1.createFrom(runtimeScene.getObjects("Jouer"));
gdjs.StageCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.StageCode.condition0IsTrue_0.val = false;
gdjs.StageCode.condition1IsTrue_0.val = false;
gdjs.StageCode.condition2IsTrue_0.val = false;
gdjs.StageCode.condition3IsTrue_0.val = false;
gdjs.StageCode.condition4IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 1;
}if ( gdjs.StageCode.condition0IsTrue_0.val ) {
{
gdjs.StageCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle1")) == 1;
}if ( gdjs.StageCode.condition1IsTrue_0.val ) {
{
gdjs.StageCode.condition2IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.StageCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Jouer", gdjs.StageCode.GDJouerObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.StageCode.condition2IsTrue_0.val ) {
{
gdjs.StageCode.condition3IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.StageCode.condition3IsTrue_0.val ) {
{
{gdjs.StageCode.conditionTrue_1 = gdjs.StageCode.condition4IsTrue_0;
gdjs.StageCode.conditionTrue_1.val = context.triggerOnce(469920484);
}
}}
}
}
}
if (gdjs.StageCode.condition4IsTrue_0.val) {
{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Jeej", false);
}}

}


{

gdjs.StageCode.GDJouerObjects1.createFrom(runtimeScene.getObjects("Jouer"));
gdjs.StageCode.GDViseurObjects1.createFrom(runtimeScene.getObjects("Viseur"));

gdjs.StageCode.condition0IsTrue_0.val = false;
gdjs.StageCode.condition1IsTrue_0.val = false;
gdjs.StageCode.condition2IsTrue_0.val = false;
gdjs.StageCode.condition3IsTrue_0.val = false;
gdjs.StageCode.condition4IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 2;
}if ( gdjs.StageCode.condition0IsTrue_0.val ) {
{
gdjs.StageCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle2")) == 1;
}if ( gdjs.StageCode.condition1IsTrue_0.val ) {
{
gdjs.StageCode.condition2IsTrue_0.val = gdjs.evtTools.object.hitBoxesCollisionTest(context.clearEventsObjectsMap().addObjectsToEventsMap("Viseur", gdjs.StageCode.GDViseurObjects1).getEventsObjectsMap(), context.clearEventsObjectsMap().addObjectsToEventsMap("Jouer", gdjs.StageCode.GDJouerObjects1).getEventsObjectsMap(), false, runtimeScene);
}if ( gdjs.StageCode.condition2IsTrue_0.val ) {
{
gdjs.StageCode.condition3IsTrue_0.val = gdjs.evtTools.input.isMouseButtonPressed(runtimeScene, "Left");
}if ( gdjs.StageCode.condition3IsTrue_0.val ) {
{
{gdjs.StageCode.conditionTrue_1 = gdjs.StageCode.condition4IsTrue_0;
gdjs.StageCode.conditionTrue_1.val = context.triggerOnce(469920988);
}
}}
}
}
}
if (gdjs.StageCode.condition4IsTrue_0.val) {
{gdjs.evtTools.sound.stopMusicOnChannel(runtimeScene, 1);
}{gdjs.evtTools.runtimeScene.replaceScene(runtimeScene, "Jeej", false);
}}

}


{



}


{


gdjs.StageCode.condition0IsTrue_0.val = false;
{
{gdjs.StageCode.conditionTrue_1 = gdjs.StageCode.condition0IsTrue_0;
gdjs.StageCode.conditionTrue_1.val = context.triggerOnce(469921276);
}
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{gdjs.evtTools.sound.playMusicOnChannel(runtimeScene, "choose.ogg", 1, true, 100, 1);
}}

}


{

gdjs.StageCode.GDMeilleursScoresObjects1.createFrom(runtimeScene.getObjects("MeilleursScores"));

gdjs.StageCode.condition0IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 0;
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{gdjs.evtTools.storage.readNumberFromJSONFile("Score.txt", "MeilleurScore", runtimeScene, runtimeScene.getVariables().get("Meilleurscore"));
}{for(var i = 0, len = gdjs.StageCode.GDMeilleursScoresObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDMeilleursScoresObjects1[i].setString("Votre meilleur score est : "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().get("Meilleurscore")) +" points.");
}
}}

}


{

gdjs.StageCode.GDMeilleursScoresObjects1.createFrom(runtimeScene.getObjects("MeilleursScores"));

gdjs.StageCode.condition0IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 1;
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{gdjs.evtTools.storage.readNumberFromJSONFile("Score.txt", "MeilleurScore1", runtimeScene, runtimeScene.getVariables().get("Meilleurscore1"));
}{for(var i = 0, len = gdjs.StageCode.GDMeilleursScoresObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDMeilleursScoresObjects1[i].setString("Votre meilleur score est : "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().get("Meilleurscore1")) +" points.");
}
}}

}


{

gdjs.StageCode.GDMeilleursScoresObjects1.createFrom(runtimeScene.getObjects("MeilleursScores"));

gdjs.StageCode.condition0IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 2;
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{gdjs.evtTools.storage.readNumberFromJSONFile("Score.txt", "MeilleurScore2", runtimeScene, runtimeScene.getVariables().get("Meilleurscore2"));
}{for(var i = 0, len = gdjs.StageCode.GDMeilleursScoresObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDMeilleursScoresObjects1[i].setString("Votre meilleur score est : "+gdjs.evtTools.common.getVariableString(runtimeScene.getVariables().get("Meilleurscore2")) +" points.");
}
}}

}


{



}


{


{gdjs.evtTools.storage.readNumberFromJSONFile("Items.txt", "Cle1", runtimeScene, runtimeScene.getVariables().get("BuyCle1"));
}
}


{


{gdjs.evtTools.storage.readNumberFromJSONFile("Items.txt", "Cle2", runtimeScene, runtimeScene.getVariables().get("BuyCle2"));
}
}


{



}


{

gdjs.StageCode.GDMeilleursScoresObjects1.createFrom(runtimeScene.getObjects("MeilleursScores"));
gdjs.StageCode.GDNomDuStageObjects1.createFrom(runtimeScene.getObjects("NomDuStage"));

gdjs.StageCode.condition0IsTrue_0.val = false;
gdjs.StageCode.condition1IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle1")) != 1;
}if ( gdjs.StageCode.condition0IsTrue_0.val ) {
{
gdjs.StageCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 1;
}}
if (gdjs.StageCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.StageCode.GDNomDuStageObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNomDuStageObjects1[i].setColor("128;128;128");
}
}{for(var i = 0, len = gdjs.StageCode.GDMeilleursScoresObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDMeilleursScoresObjects1[i].setColor("128;128;128");
}
}}

}


{

gdjs.StageCode.GDMeilleursScoresObjects1.createFrom(runtimeScene.getObjects("MeilleursScores"));
gdjs.StageCode.GDNomDuStageObjects1.createFrom(runtimeScene.getObjects("NomDuStage"));

gdjs.StageCode.condition0IsTrue_0.val = false;
gdjs.StageCode.condition1IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getVariables().get("BuyCle1")) != 1;
}if ( gdjs.StageCode.condition0IsTrue_0.val ) {
{
gdjs.StageCode.condition1IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 1;
}}
if (gdjs.StageCode.condition1IsTrue_0.val) {
{for(var i = 0, len = gdjs.StageCode.GDNomDuStageObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNomDuStageObjects1[i].setColor("128;128;128");
}
}{for(var i = 0, len = gdjs.StageCode.GDMeilleursScoresObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDMeilleursScoresObjects1[i].setColor("128;128;128");
}
}}

}


{

gdjs.StageCode.GDMeilleursScoresObjects1.createFrom(runtimeScene.getObjects("MeilleursScores"));
gdjs.StageCode.GDNomDuStageObjects1.createFrom(runtimeScene.getObjects("NomDuStage"));

gdjs.StageCode.condition0IsTrue_0.val = false;
{
gdjs.StageCode.condition0IsTrue_0.val = gdjs.evtTools.common.getVariableNumber(runtimeScene.getGame().getVariables().get("Monde")) == 0;
}if (gdjs.StageCode.condition0IsTrue_0.val) {
{for(var i = 0, len = gdjs.StageCode.GDMeilleursScoresObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDMeilleursScoresObjects1[i].setColor("255;255;255");
}
}{for(var i = 0, len = gdjs.StageCode.GDNomDuStageObjects1.length ;i < len;++i) {
    gdjs.StageCode.GDNomDuStageObjects1[i].setColor("255;255;255");
}
}}

}

return;
}
gdjs['StageCode']= gdjs.StageCode;
