import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'package:drawer_manager/drawer_manager.dart';
import 'package:smpn2parepare/counter.dart';
import 'package:smpn2parepare/hello.dart';
import 'package:smpn2parepare/page/Jadwal.dart';
import 'package:smpn2parepare/page/Kuis.dart';
import 'package:smpn2parepare/page/Materi.dart';
import 'package:smpn2parepare/page/Tugas.dart';
import 'package:smpn2parepare/the_mac.dart';

class UtamaScreen extends StatelessWidget {
  const UtamaScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider<DrawerManagerProvider>(
        create: (_) => DrawerManagerProvider(),
        child: MaterialApp(
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
        return 'Jadwal';
      case 1:
        return 'Materi';
      case 2:
        return 'Tugas';
      case 3:
        return 'Kuis';
      case 4:
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
      JadwalScreen(),
      MateriScreen(),
      TugasScreen(),
      KuisScreen(),
      KuisScreen(),
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
              leading: const Icon(Icons.calendar_month),
              title: Text(_getTitle(0)),
              onTap: () async {
                // RUN A BACKEND Hello, Flutter OPERATION
              },
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.book),
              title: Text(_getTitle(1)),
              onTap: () async {
                // RUN A BACKEND Counter OPERATION
              },
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.task),
              title: Text(_getTitle(2)),
              onTap: () async {
                // RUN A BACKEND Hello, Flutter OPERATION
              },
            ),
            DrawerTile(
              context: context,
              leading: const Icon(Icons.task),
              title: Text(_getTitle(3)),
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
              leading: const Icon(Icons.logout),
              title: Text(_getTitle(4)),
              onTap: () async {
                // RUN A BACKEND Signup OPERATION
              },
            ),
          ],
          tileSelections: drawerSelections,
        ));
  }
}
