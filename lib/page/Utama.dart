import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'package:drawer_manager/drawer_manager.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/page/Dashboard.dart';
import 'package:smpn2parepare/page/Jadwal.dart';
import 'package:smpn2parepare/page/Kuis.dart';
import 'package:smpn2parepare/page/KuisBaru.dart';
import 'package:smpn2parepare/page/Materi.dart';
import 'package:smpn2parepare/page/Tugas.dart';
import 'package:smpn2parepare/page/TugasBaru.dart';
import 'package:smpn2parepare/page/Ujian.dart';
import 'package:smpn2parepare/page/test.dart';

class UtamaScreen extends StatelessWidget {
  static const String routeName = "/utama";

  const UtamaScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider<DrawerManagerProvider>(
        create: (_) => DrawerManagerProvider(),
        child: MaterialApp(
          debugShowCheckedModeBanner: false,
          title: 'SMPN 2 Parepare',
          theme: ThemeData(primarySwatch: Colors.blue),
          home: const MyHomePage(),
        ));
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({Key? key}) : super(key: key);
  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  String _getTitle(int index) {
    switch (index) {
      case 0:
        return 'Dashboard';
      case 1:
        return 'Jadwal';
      case 2:
        return 'Materi';
      case 3:
        return 'Tugas';
      case 4:
        return 'Kuis';
      case 5:
        return 'Ujian';
      case 6:
        return 'Keluar';
      default:
        return '';
    }
  }

  void tutup() {
    SystemNavigator.pop();
  }

  Widget _getTitleWidget() {
    return Consumer<DrawerManagerProvider>(builder: (context, dmObj, _) {
      return Text(_getTitle(dmObj.selection));
    });
  }

  @override
  Widget build(BuildContext context) {
    const drawerSelections = [
      Dashboard(),
      JadwalScreen(),
      MateriScreen(),
      TugasScreenBaru(),
      KuisScreenBaru(),
      // KuisScreen(),
      UjianScreen(),
      UjianScreen(),
    ];

    final manager = Provider.of<DrawerManagerProvider>(context, listen: false);

    return Scaffold(
        appBar: AppBar(title: _getTitleWidget()),
        body: manager.body,
        drawer: DrawerManager(
          context,
          drawerElements: [
            const DrawerHeader(
              decoration: BoxDecoration(color: Colors.blue),
              child: Padding(
                padding: EdgeInsets.only(bottom: 20),
                child: Icon(
                  Icons.account_circle,
                  color: Colors.blueGrey,
                  size: 96,
                ),
              ),
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.dashboard),
              title: Text(_getTitle(0)),
              onTap: () async {
                // RUN A BACKEND Hello, Flutter OPERATION
              },
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.calendar_month),
              title: Text(_getTitle(1)),
              onTap: () async {
                // RUN A BACKEND Hello, Flutter OPERATION
              },
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.book),
              title: Text(_getTitle(2)),
              onTap: () async {
                // RUN A BACKEND Counter OPERATION
              },
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.task),
              title: Text(_getTitle(3)),
              onTap: () async {
                // RUN A BACKEND Hello, Flutter OPERATION
              },
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.task),
              title: Text(_getTitle(4)),
              onTap: () async {
                // RUN A BACKEND Counter OPERATION
              },
            ),
            const Padding(
              padding: EdgeInsets.symmetric(horizontal: 16),
              child: Divider(),
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.qr_code),
              title: Text(_getTitle(5)),
              onTap: () async {
                // RUN A BACKEND Signup OPERATION
              },
            ),
            const Padding(
              padding: EdgeInsets.symmetric(horizontal: 16),
              child: Divider(),
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.logout),
              title: Text(_getTitle(6)),
              onTap: () async {
                final prefs = await SharedPreferences.getInstance();

                await prefs.setBool('LoginSiswa', false);

                SystemNavigator.pop();
              },
            )
          ],
          tileSelections: drawerSelections,
        ));
  }
}
