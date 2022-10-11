//----------------------------------------Include the NodeMCU ESP8266 Library
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include <LiquidCrystal.h>
#include <BigFont01_I2C.h>
#include <LiquidCrystal_I2C.h>
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>
#include <NTPClient.h>
#include <WiFiUdp.h>
//----------------------------------------

// Define NTP Client to get time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org");

//Week Days
String weekDays[7] = {"6", "0", "1", "2", "3", "4", "5"};

//----------------------------------------
#define ON_Board_LED 2  //--> Defining an On Board LED (GPIO2 = D4), used for indicators when the process of connecting to a wifi router
const unsigned char Active_buzzer = 15; //d8 pin
WiFiClient wifiClient;
int lcdColumns = 16; //--> set the LCD number of columns
int lcdRows = 2; //--> set the LCD number of rows

// set LCD address, number of columns and rows
// if you don't know your display address, run an I2C scanner sketch
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);

//----------------------------------------Web Server address / IPv4
// If using IPv4, press Windows key + R then type cmd, then type ipconfig (If using Windows OS).
const char *host = "http://ioe.scienceontheweb.net/";
//----------------------------------------

// Set web server port number to 80
WiFiServer server(80);

// Variable to store the HTTP request
String header;


// Function to scroll text
void scrollText(int row, String message, int delayTime, int lcdColumns) {
  for (int i = 0; i < lcdColumns; i++) {
    message = " " + message;
  }
  message = message + " ";
  for (int pos = 0; pos < message.length(); pos++) {
    lcd.setCursor(0, row);
    lcd.print(message.substring(pos, pos + lcdColumns));
    delay(delayTime);
  }
}


void setup() {
  // initialize LCD
  lcd.init();
  // turn on LCD backlight
  lcd.backlight();

  // put your setup code here, to run once:
  Serial.begin(115200);
  delay(500);



  pinMode(ON_Board_LED, OUTPUT); //--> On Board LED port Direction output
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off Led On Board

  pinMode(Active_buzzer, OUTPUT); //--> buzzer port Direction output


  // WiFiManager
  // Local intialization. Once its business is done, there is no need to keep it around
  WiFiManager wifiManager;

  // Uncomment and run it once, if you want to erase all the stored information
  //wifiManager.resetSettings();

  // set custom ip for portal
  //wifiManager.setAPConfig(IPAddress(001,001,001,001));

  // fetches ssid and pass from eeprom and tries to connect
  // if it does not connect it starts an access point with the specified name
  // here  "AutoConnectAP"
  // and goes into a blocking loop awaiting configuration
  wifiManager.autoConnect("AOTG Wi-Fi Manager");
  // or use this for auto generated name ESP + ChipID
  //wifiManager.autoConnect();


  lcd.setCursor(0, 0);

  //----------------------------------------Wait for connection
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    String display_connection = "Connecting to wifi";
    lcd.print(display_connection);
    lcd.clear();
    //----------------------------------------Make the On Board Flashing LED on the process of connecting to the wifi router.
    digitalWrite(ON_Board_LED, LOW);
    delay(250);
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);
    //----------------------------------------
  }

  while (WiFi.status() != WL_CONNECT_FAILED && WiFi.status() != WL_CONNECTED) {
    String display_connection = "Please connect to wifi";
    scrollText(0, display_connection, 400, lcdColumns);//slow
    lcd.clear();
    //----------------------------------------Make the On Board Flashing LED on the process of connecting to the wifi router.
    digitalWrite(ON_Board_LED, LOW);
    delay(1000);
    digitalWrite(ON_Board_LED, HIGH);
    delay(500);
    //----------------------------------------
  }
  //----------------------------------------
  // if you get here you have connected to the WiFi
  Serial.println("Connected.");
  String display_connection = "Wifi Connected";
  lcd.print(display_connection);
  lcd.clear();
  digitalWrite(ON_Board_LED, LOW); //--> Turn ON the On Board LED when it is connected to the wifi router.
  //----------------------------------------If successfully connected to the wifi router, the IP Address that will be visited is displayed in the serial monitor
  Serial.println("");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println();
  //----------------------------------------time setting
  // Initialize a NTPClient to get time
  timeClient.begin();
  // Set offset time of timezone in seconds +1= 3600
  timeClient.setTimeOffset(19800);
  //----------------------------------------
  server.begin();

}

void loop() {
  timeClient.update();
  String weekDay = weekDays[timeClient.getDay()];
  Serial.print("Week Day: ");
  Serial.println(weekDay);

  // put your main code here, to run repeatedly:
  HTTPClient http; //--> Declare object of class HTTPClient

  //----------------------------------------Getting Data from MySQL Database
  String url, Link, postData, postData0, postData1, postData2, LEDStatResultSend, lecture_id, current_lecture_id, startup_details, schedule_details, currentTime;
  int Device_id = 1; //--> ID in Database

  url = "project/GetData.php";
  Link = host + url; //--> Make a Specify request destination
  postData = "Device_id=" + String(Device_id);

  Serial.println("----------------Connect to Server-----------------");
  Serial.println("Get srno from Server or Database");
  Serial.print("Request Link : ");
  Serial.println(Link);
  http.begin(wifiClient, Link); //--> Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
  int httpCodeGet = http.POST(postData); //--> Send the request

  if (httpCodeGet == 200) {
    startup_details = http.getString(); //--> Get the response payload from server
    Serial.print("Response Code : "); //--> If Response Code = 200 means Successful connection, if -1 means connection failed. For more information see here : https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
    Serial.println(httpCodeGet); //--> Print HTTP return code
    Serial.print("Returned data from Server : ");
    Serial.println(startup_details); //--> Print request response payload

    int startup_details_length[2][2] = {{0, startup_details.length() - 3}, {startup_details.length() - 2, startup_details.length()}} ;
    String display_startup_details[2];
    for (int i = 0; i < 2; i++) {
      display_startup_details[i] = startup_details.substring(startup_details_length[i][0], startup_details_length[i][1]);
    }
    Serial.println(display_startup_details[1]);
    Serial.println(display_startup_details[0]);

    postData0 = "class_name=" + String(display_startup_details[0]);
    postData1 = "&weekDay=" + String(weekDay);
    postData2 = "&current_lecture_id=" + String(display_startup_details[1]);
    postData = postData0 + postData1 + postData2;
    http.begin(wifiClient, Link); //--> Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
    int httpCodeGet = http.POST(postData); //--> Send the request
    schedule_details = http.getString(); //--> Get the response payload from server
    Serial.print("Returned data from Server : ");
    Serial.println(schedule_details); //--> Print request response payload

    int schedule_details_length[2][2] = {{schedule_details.length() - 5, schedule_details.length()}, {0, schedule_details.length() - 14}} ;
    String display_schedule_details[2];
    for (int i = 0; i < 2; i++) {
      display_schedule_details[i] = schedule_details.substring(schedule_details_length[i][0], schedule_details_length[i][1]);
    }

    digitalWrite(Active_buzzer, HIGH) ; //Turn on active buzzer
    delay(1000);
    digitalWrite(Active_buzzer, LOW) ; //Turn off active buzzer


    // for (int i = 0; i <= 2; i++) {
    while (1) {
      timeClient.update();
      int currentHour = timeClient.getHours();
      Serial.print("Hour: ");
      Serial.println(currentHour);

      int currentMinute = timeClient.getMinutes();
      Serial.print("Minutes: ");
      Serial.println(currentMinute);

      if ((currentHour >= 0 && currentHour <= 9) && (currentMinute >= 0 && currentMinute <= 9)) {
        currentTime =  "0" + String(currentHour) + ".0"  + String(currentMinute);
      } else if (currentHour >= 0 && currentHour <= 9) {
        currentTime =  "0" + String(currentHour) + "."  + String(currentMinute);
      } else if (currentMinute >= 0 && currentMinute <= 9) {
        currentTime =  String(currentHour) + ".0" + String(currentMinute);
      } else {
        currentTime = String(currentHour) + "."  + String(currentMinute);
      }

      Serial.println("full time");
      Serial.println(currentTime);
      Serial.println(display_schedule_details[0]);
      if (currentTime == display_schedule_details[0]) {
        break;
      }
      // set cursor to first column, first row
      lcd.setCursor(0, 0);
      // print scrolling message
      scrollText(0, display_schedule_details[1], 400, lcdColumns);//slow


      // clears the display to print new message
      lcd.clear();
    }

  } else {
    Serial.print("Response Code : "); //--> If Response Code = 200 means Successful connection, if -1 means connection failed. For more information see here : https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
    Serial.println(httpCodeGet); //--> Print HTTP return code
    LEDStatResultSend = "Srever not get data";
    scrollText(0, LEDStatResultSend, 400, lcdColumns);//slow


    // clears the display to print new message
    lcd.clear();
  }

  Serial.println("----------------Closing Connection----------------");
  http.end(); //--> Close connection
  Serial.println();
  Serial.println("Please wait 5 seconds for the next connection.");
  Serial.println();
  delay(1000); //--> GET Data at every 5 seconds
}
