import 'package:flutter/material.dart';
import 'package:smpn2parepare/page/Login.dart';
import 'package:smpn2parepare/page/LoginBaru.dart';
import 'package:smpn2parepare/page/Utama.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: "E-Learning SMPN 2 Kota Parepare",
      initialRoute: '/',
      routes: {
        '/': (context) => LoginScreenBaru(),
        '/utama': (context) => UtamaScreen(),
      },
    );
  }
}
