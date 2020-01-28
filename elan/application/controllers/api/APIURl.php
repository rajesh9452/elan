1.
Name: Access token 
URL: http://localhost/elan/api/AccessToken
Request:{
  "elan": {
    "deviceId": "123456"
  }
}
--------Response----------
{
  "elan": {
    "res_code": "1",
    "res_msg": "Success",
    "tokenAccess": "c755c0b544c1962101e93d33b011b7573301faab90a59d7fffa57a333515ad50481289030f428128177f3c45af63f2479f1de1c3be5e643024f2edfd3ec6bc7f4c2c039ea1bc2d0b2d3915bfe4f9b320c651be93fdb68a026527f7d27a08bbeac98d785d605782b1dddd8f0a0dba4981d2f66df764cc12dc952f9933e537571bbfcd23b260d24775b2e39a4b212e02e8ededd46da780",
    "accessId": 4
  }
+++++++++++++++++++++++++++++++++++++++++
2. Name: Account login
URL: http://localhost/elan/api/LoginAccount
Header Request: accessToken => '',packageName => '',accessId => '',deviceId=>''
Request: {
  "elan": {
    "email": "r_ksingh@hotmail.com",
    "password":"123456",
    "fcm_id":"748575"
  }
}
----------- Response -----------------
{
  "elan": {
    "res_code": "1",
    "res_msg": "Success",
    "userId": "7",
    "loginId": "5",
    "name": "Rajesh kumar",
    "email": "r_ksingh@hotmail.com",
    "mobileNumber": "9452135246"
  }
}
++++++++++++++++++++++++++++++++++++++++++
3. Name: forgot password
URL: http://localhost/elan/api/ForgotPassword
Header Request: packageName => ''
Request: {
  "elan": {
    "email": "r_ksingh@hotmail.com"
  }
}
----------- Response -----------------
{
  "elan": {
    "res_code": "1",
    "res_msg": "Your password has been send on your email id."
  }
}

++++++++++++++++++++++++++++++++++++++++++++++++++
4. Name: Support
URL : http://localhost/elan/api/Support
Header Request: accessToken => '',packageName => '',accessId => '',deviceId=>''
Request:{
  "elan": {
    "userId": "7",
    "subject": "hello",
    "message": "i am testing"
  }
}
------------- Response-------------
{"elan":{"res_code":"1","res_msg":"Your feedback has been successfully submit"}}
++++++++++++++++++++++++++++++++++++++++++++++++++++++++
5. Name: change password
URL: http://localhost/elan/api/ChangePassword
Header Request: accessToken => '',packageName => '',accessId => '',deviceId=>''
Request:{
  "elan": {
    "userId": "7",
    "newPassword": "123456",
    "oldpassword": "1234567"
  }
}
--------- Response -------------
{"elan":{"res_code":"1","res_msg":"Password has been change successfully"}}
+++++++++++++++++++++++++++++++++++++++++++++++++++
6. Name: logout account
URL: http://localhost/elan/api/Logout
Header Request: accessToken => '',packageName => '',accessId => '',deviceId=>''
Request: {
  "elan": {
    "loginId": "5"
  }
}
-------- Response -------------------
{"elan":{"res_code":"1","res_msg":"Logged out successfully Done."}}
++++++++++++++++++++++++++++++++++++++++++++
7.
