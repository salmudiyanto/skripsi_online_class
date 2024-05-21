import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:lottie/lottie.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/page/Utama.dart';

class LoginScreenBaru extends StatefulWidget {
  const LoginScreenBaru({super.key});

  @override
  State<LoginScreenBaru> createState() => _LoginScreenBaruState();
}

class _LoginScreenBaruState extends State<LoginScreenBaru> {
  final _formKey = GlobalKey<FormState>();
  final _emailFormFieldKey = GlobalKey<FormState>();
  final _passwordFormFieldKey = GlobalKey<FormState>();
  String? email = '', password = '';
  bool load = true;
  String paswordFieldSuffixText = "Tampilkan";
  late FocusNode passwordFocusNode;
  bool _obscureText = true;
  final TextEditingController _emailControl = new TextEditingController();
  final TextEditingController _passControl = new TextEditingController();

  ceklogin() async {
    final prefs = await SharedPreferences.getInstance();
    if (prefs.getBool('LoginSiswa') == true) {
      Navigator.pushNamedAndRemoveUntil(
          context, UtamaScreen.routeName, (route) => false);
    } else {
      setState(() {
        load = false;
      });
    }
  }

  _signIn() async {
    Fluttertoast.showToast(
        msg: "Mohon Tunggu...",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    final response = await http.post(
        Uri.parse("${VariableAPK.url}apiloginsiswa"),
        body: {"email": _emailControl.text, "password": _passControl.text});
    print("${VariableAPK.url}apiloginsiswa");
    print(_passControl.text);
    final data = jsonDecode(response.body);
    String stat = data['status'];
    Fluttertoast.showToast(
        msg: data['message'],
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    if (stat == "OK") {
      _simpanLogin(data['id_siswa'], data['nama_siswa']).whenComplete(() =>
          Navigator.pushNamedAndRemoveUntil(
              context, UtamaScreen.routeName, (route) => false));
    } else {}
  }

  Future _simpanLogin(int id, String nama) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setInt('idSiswa', id);
    await prefs.setString('namaSiswa', nama);
    await prefs.setBool('LoginSiswa', true);
  }

  @override
  void initState() {
    passwordFocusNode = FocusNode();
    ceklogin();

    // TODO: implement initState
    super.initState();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
    passwordFocusNode.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: load
          ? Center(
              child: CircularProgressIndicator(
                color: Colors.amber,
              ),
            )
          : Container(
              decoration: const BoxDecoration(
                  // color: Colors.red.withOpacity(0.1),
                  image: DecorationImage(
                      image: AssetImage("assets/bg.jpg"),
                      fit: BoxFit.cover,
                      opacity: 0.3)),
              child: SafeArea(
                child: Center(
                  child: SingleChildScrollView(
                    scrollDirection: Axis.vertical,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        // Lottie.network(
                        //     // 'https://assets6.lottiefiles.com/private_files/lf30_ulp9xiqw.json', //shakeing lock
                        //     'https://assets6.lottiefiles.com/packages/lf20_k9wsvzgd.json',
                        //     animate: true,
                        //     height: 100,
                        //     width: 500),
                        // logo here
                        Image.asset(
                          'assets/icon.jpg',
                          height: 120,
                          width: 120,
                        ),
                        const Text(
                          'Login',
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 40,
                          ),
                        ),
                        const Text(
                          'SMP Negeri 2 Parepare',
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 15,
                          ), 
                        ),

                        const SizedBox(
                          height: 20,
                        ),
                        Container(
                          height: 300,
                          width: MediaQuery.of(context).size.width / 1.1,
                          decoration: BoxDecoration(
                              color: Colors.white.withOpacity(0.3),
                              borderRadius: BorderRadius.circular(20)),
                          child: Column(
                            children: [
                              Padding(
                                padding: const EdgeInsets.only(
                                    left: 20, right: 20, bottom: 20, top: 20),
                                child: TextFormField(
                                  controller: _emailControl,
                                  onSaved: (newEmail) {
                                    setState(() {
                                      email = newEmail;
                                    });
                                  },
                                  decoration: const InputDecoration(
                                    focusedBorder: UnderlineInputBorder(
                                        borderSide: BorderSide.none,
                                        borderRadius: BorderRadius.all(
                                            Radius.circular(10))),
                                    enabledBorder: UnderlineInputBorder(
                                        borderSide: BorderSide.none,
                                        borderRadius: BorderRadius.all(
                                            Radius.circular(10))),
                                    prefixIcon: Icon(
                                      Icons.person,
                                      color: Color.fromRGBO(0, 168, 218, 1),
                                    ),
                                    filled: true,
                                    fillColor: Colors.white,
                                    labelText: "Email",
                                    hintText: 'email-anda@mail.com',
                                    labelStyle: TextStyle(
                                        color: Color.fromRGBO(0, 168, 218, 1)),
                                    // suffixIcon: IconButton(
                                    //     onPressed: () {},
                                    //     icon: Icon(Icons.close,
                                    //         color: Colors.purple))
                                  ),
                                ),
                              ),
                              Padding(
                                padding:
                                    const EdgeInsets.only(left: 20, right: 20),
                                child: Form(
                                  key: _formKey,
                                  child: TextFormField(
                                    obscuringCharacter: '*',
                                    obscureText: true,
                                    onSaved: (newPassword) {
                                      setState(() {
                                        password = newPassword;
                                      });
                                    },
                                    controller: _passControl,
                                    decoration: const InputDecoration(
                                      focusedBorder: UnderlineInputBorder(
                                          borderSide: BorderSide.none,
                                          borderRadius: BorderRadius.all(
                                              Radius.circular(10))),
                                      enabledBorder: UnderlineInputBorder(
                                          borderSide: BorderSide.none,
                                          borderRadius: BorderRadius.all(
                                              Radius.circular(10))),
                                      prefixIcon: Icon(
                                        Icons.person,
                                        color: Color.fromRGBO(0, 168, 218, 1),
                                      ),
                                      filled: true,
                                      fillColor: Colors.white,
                                      labelText: "Password",
                                      hintText: '*********',
                                      labelStyle: TextStyle(
                                          color:
                                              Color.fromRGBO(0, 168, 218, 1)),
                                    ),
                                    validator: (value) {
                                      if (value!.isEmpty && value!.length < 5) {
                                        return 'Enter a valid password';
                                        {
                                          return null;
                                        }
                                      }
                                    },
                                  ),
                                ),
                              ),
                              SizedBox(
                                height: 30,
                              ),
                              ElevatedButton(
                                  style: ElevatedButton.styleFrom(
                                      shape: RoundedRectangleBorder(
                                          borderRadius:
                                              BorderRadius.circular(10.0)),
                                      backgroundColor:
                                          Color.fromRGBO(0, 168, 218, 1),
                                      padding: EdgeInsets.symmetric(
                                          horizontal: 131, vertical: 20)
                                      // padding: EdgeInsets.only(
                                      //     left: 120, right: 120, top: 20, bottom: 20),
                                      ),
                                  onPressed: () {
                                    if (_formKey.currentState!.validate()) {
                                      // If the form is valid, display a snackbar. In the real world,
                                      // you'd often call a server or save the information in a database.
                                      _signIn();
                                    }
                                    // Navigator.push(
                                    //     context,
                                    //     MaterialPageRoute(
                                    //         builder: (context) => loginScreen()));
                                  },
                                  child: Text(
                                    'Log In',
                                    style: TextStyle(fontSize: 17),
                                  )),
                            ],
                          ),
                        ),

                        //this is button
                        // const SizedBox(
                        //   height: 30,
                        // ),
                        // ElevatedButton(
                        //     style: ElevatedButton.styleFrom(
                        //         shape: RoundedRectangleBorder(
                        //             borderRadius: BorderRadius.circular(10.0)),
                        //         backgroundColor: Colors.purple,
                        //         padding: EdgeInsets.symmetric(
                        //             horizontal: MediaQuery.of(context).size.width / 3.3,
                        //             vertical: 20)
                        //         // padding: EdgeInsets.only(
                        //         //     left: 120, right: 120, top: 20, bottom: 20),
                        //         ),
                        //     onPressed: () {
                        //       Navigator.push(
                        //           context,
                        //           MaterialPageRoute(
                        //               builder: (context) => loginScreen()));
                        //     },
                        //     child: Text(
                        //       'Sounds Good!',
                        //       style: TextStyle(fontSize: 17),
                        //     )), //
                      ],
                    ),
                  ),
                ),
              ),
            ),
    );
  }
}
