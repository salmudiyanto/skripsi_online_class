import 'package:flutter/material.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/page/test.dart';
import 'package:smpn2parepare/viewmodel/vm_mapel.dart';
import 'package:smpn2parepare/viewmodel/vm_nilaiujian.dart';
import 'package:smpn2parepare/viewmodel/vm_tugassoal.dart';
import 'package:smpn2parepare/widget/customCard.dart';
import 'package:smpn2parepare/widget/custom_tabbar.dart';

class UjianScreen extends StatefulWidget {
  const UjianScreen({super.key});

  @override
  State<UjianScreen> createState() => UjianScreenState();
}

class UjianScreenState extends State<UjianScreen> {
  bool load = true;
  List mapelJson = [];
  int idSiswa = 0;
  String _id = '';
  late List<Widget> tabViewItems;

  Future<void> _scanQR() async {
    String barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
        "#ff6666", "Cancel", true, ScanMode.QR);

    setState(() {
      _id = barcodeScanRes;
      if (_id != "-1") {
        Navigator.of(context).push(MaterialPageRoute(
            builder: (context) => SimpleMultipleChoice(
                  qrnya: _id,
                ))); // mengisi variabel _id dengan nilai yang dikembalikan dari QR scanner
      }
    });
  }

  final List<String> tabBarItems = ["Ujian", "Nilai"];
  TabBarLocation _tabBarLocation = TabBarLocation.top;

  IconButton _appBarActionButton() {
    return IconButton(
        onPressed: () {
          setState(() {
            if (_tabBarLocation == TabBarLocation.top) {
              setState(() {
                _tabBarLocation = TabBarLocation.bottom;
              });
            } else {
              setState(() {
                _tabBarLocation = TabBarLocation.top;
              });
            }
          });
        },
        icon: AnimatedCrossFade(
            firstChild: const Icon(Icons.arrow_circle_down_outlined),
            secondChild: const Icon(Icons.arrow_circle_up_outlined),
            crossFadeState: _tabBarLocation == TabBarLocation.top
                ? CrossFadeState.showFirst
                : CrossFadeState.showSecond,
            duration: const Duration(milliseconds: 200)));
  }

  void getDataSoal() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      // idSiswa = 11;
      idSiswa = prefs.getInt('idSiswa')!;
    });
    NilaiUjianVM().getNilaiUjian(idSiswa.toString(), '4', 'B').then((value) {
      setState(() {
        mapelJson = value;
        print(mapelJson);
        load = false;

        tabViewItems = [
          UjianList(),
          NilaiList(
            nilaiJson: mapelJson,
          ),
        ];
      });
    });
  }

  @override
  void initState() {
    getDataSoal();
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;

    return load
        ? Center(
            child: CircularProgressIndicator(
              color: Colors.amber,
            ),
          )
        : Column(
            children: [
              SingleChildScrollView(
                scrollDirection: Axis.horizontal,
                child: CustomTabBar(
                  padding: EdgeInsets.only(left: 10, right: 10),
                  tabBarItems: tabBarItems,
                  tabBarItemWidth: size.width * 0.7,
                  tabViewItems: tabViewItems,
                  tabBarLocation: _tabBarLocation,
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(50)),
                  tabBarItemHeight: MediaQuery.of(context).size.height * 0.06,
                  tabViewItemHeight: MediaQuery.of(context).size.height * 0.80,
                ),
              )
            ],
          );
  }
}

class UjianList extends StatefulWidget {
  const UjianList({super.key});

  @override
  State<UjianList> createState() => _UjianListState();
}

class _UjianListState extends State<UjianList> {
  String _id = '';

  Future<void> _scanQR() async {
    String barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
        "#ff6666", "Cancel", true, ScanMode.QR);

    setState(() {
      _id = barcodeScanRes;
      if (_id != "-1") {
        Navigator.of(context).push(MaterialPageRoute(
            builder: (context) => SimpleMultipleChoice(
                  qrnya: _id,
                ))); // mengisi variabel _id dengan nilai yang dikembalikan dari QR scanner
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.fromLTRB(10, 30, 10, 10),
      child: Container(
        child: ElevatedButton(
          onPressed: () {
            _scanQR();
          },
          child: Center(child: Text("Mulai Ujian")),
        ),
      ),
    );
  }
}

class NilaiList extends StatelessWidget {
  final List nilaiJson;
  const NilaiList({super.key, required this.nilaiJson});

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;

    return Container(
      width: size.width * 0.8,
      // color: Colors.black,
      child: Expanded(
        child: SingleChildScrollView(
          scrollDirection: Axis.horizontal,
          child: Container(
            width: size.width,
            decoration: const BoxDecoration(
                // color: Colors.red.withOpacity(0.1),
                image: DecorationImage(
                    image: AssetImage("assets/bg.jpg"),
                    fit: BoxFit.cover,
                    opacity: 0.3)),
            child: Padding(
              padding: EdgeInsets.fromLTRB(0, 50, 0, 0),
              child: Column(
                children: [
                  Text(
                    "Nilai Ujian",
                    style: TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                        decoration: TextDecoration.underline),
                  ),
                  Container(
                    // width: size.width * 0.6,
                    // margin: EdgeInsets.fromLTRB(5, 5, 5, 5),
                    child: DataTable(
                      dividerThickness: 2,
                      border: TableBorder.all(
                        width: 1.0,
                        color: Colors.black,
                      ),
                      columns: <DataColumn>[
                        // DataColumn(
                        //   label: Text(
                        //     "No.",
                        //     style: TextStyle(fontWeight: FontWeight.bold),
                        //   ),
                        // ),
                        DataColumn(
                          label: Text(
                            "Mapel",
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                        DataColumn(
                          label: Text(
                            "Nilai",
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                      ],
                      rows: nilaiJson
                          .map((element) => DataRow(cells: <DataCell>[
                                // DataCell(
                                //   Text(element.urut),
                                // ),
                                DataCell(
                                  Text(element.namamapel.toString()),
                                ),
                                DataCell(
                                  Text(element.nilaitot.toString()),
                                ),
                              ]))
                          .toList(),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
