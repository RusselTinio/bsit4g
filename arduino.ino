#include <LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>


const char *ssid = "TinioHouse(2.4G)";
const char *password = "JOELLAARNI";


// potentiometer
  int potValue = 0;
// potentiometer
ESP8266WebServer server(80);

LiquidCrystal_I2C lcd(0x27,16,2);
//all function will be coded here
void handleRoot() {
  potValue = map(analogRead(A0),0,1024,0,100);
  String response = String("updatePotValue(") + String(potValue) + ");";
  server.send(200, "text/javascript", response);

}

void hello(){
  lcd.clear();
  lcd.print("Hello World");
}

void count(){
  lcd.clear();
  for(int i=0;i<100;i++){
    lcd.clear();
    lcd.print("Counter: ");
    lcd.print(i+1);
    delay(500);
  }lcd.clear();
}

void countDown(){
  lcd.clear();
  for(int i=10;i>=0;i--){
    lcd.clear();
    lcd.print("Count Down: ");
    lcd.print(i);
    delay(500);
  }lcd.clear();
}

void handleDisplay() {
  String message = server.arg("message");
  
  lcd.clear();
  lcd.print("Received: ");
  lcd.setCursor(0, 1);
  lcd.print(message);

  server.send(200, "text/plain", "LCD updated"+message);
}

void handlePotValue() {
  int potValue = map(analogRead(A0),0,1024,0,100);

  server.send(200, "text/plain", String(potValue));
}

//all function will be coded here
void setup() {
  Serial.begin(115200);

  pinMode(A0, INPUT);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
  //routing
  server.on("/", HTTP_GET, handleRoot);
  server.on("/hello", HTTP_GET, hello);
  server.on("/count", HTTP_GET, count);
  server.on("/countDown", HTTP_GET, countDown);
  server.on("/display", HTTP_GET, handleDisplay);
  server.on("/getPotValue", HTTP_GET, handlePotValue);
   //routing

  server.begin();
  //for lcd
  lcd.init();
  lcd.backlight();
}

void loop() {
  server.handleClient();

}


