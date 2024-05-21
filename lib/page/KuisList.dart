import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/viewmodel/vm_mapel.dart';
import 'package:smpn2parepare/viewmodel/vm_kuissoal.dart';
import 'package:smpn2parepare/viewmodel/vm_tugassoal.dart';
import 'package:smpn2parepare/widget/KuisCard.dart';
import 'package:smpn2parepare/widget/KuisCard.dart';
import 'package:smpn2parepare/widget/KuisListCard.dart';
import 'package:smpn2parepare/widget/appbar.dart';
import 'package:smpn2parepare/widget/customCard.dart';
import 'package:smpn2parepare/widget/custom_tabbar.dart';

class KuisList extends StatefulWidget {
  final String mapel;
  const KuisList({super.key, required this.mapel});

  @override
  State<KuisList> createState() => KuisScreenState();
}

class KuisScreenState extends State<KuisList> {
  bool load = true;
  List mapelJson = [];
  int idSiswa = 0;
  late List<Widget> tabViewItems;
  void getDataSoal() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      // idSiswa = 11;
      idSiswa = prefs.getInt('idSiswa')!;
    });
    KuisSoalVM()
        .getKuisSoal(idSiswa.toString(), widget.mapel, 'B')
        .then((value) {
      setState(() {
        mapelJson = value;
        print(mapelJson);
        load = false;

        tabViewItems = [
          KuisListView(
            mapelJson: mapelJson,
          ),
          NilaiList(
            nilaiJson: mapelJson,
          ),
        ];
      });
    });
  }

  final List<String> tabBarItems = ["Kuis", "Nilai"];
  TabBarLocation _tabBarLocation = TabBarLocation.top;

  @override
  void initState() {
    getDataSoal();
    // TODO: implement initState
    super.initState();
  }

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

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;
    return Scaffold(
        appBar: kosongAppbar(context, "Kuis"),
        body: load
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
                      tabBarItemHeight:
                          MediaQuery.of(context).size.height * 0.06,
                      tabViewItemHeight:
                          MediaQuery.of(context).size.height * 0.80,
                    ),
                  )
                ],
              ));
  }
}

class KuisListView extends StatelessWidget {
  final List mapelJson;
  const KuisListView({super.key, required this.mapelJson});

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;

    return Padding(
      padding: const EdgeInsets.only(bottom: 5),
      child: Container(
        width: size.width * 0.8,
        decoration: const BoxDecoration(
            // color: Colors.red.withOpacity(0.1),
            image: DecorationImage(
                image: AssetImage("assets/bg.jpg"),
                fit: BoxFit.cover,
                opacity: 0.2)),
        child: ListView.builder(
            scrollDirection: Axis.vertical,
            shrinkWrap: true,
            itemCount: mapelJson == null ? 0 : mapelJson.length,
            itemBuilder: (BuildContext context, int index) {
              return KuisListCard(
                nomor: index + 1,
                nama: mapelJson[index].namaMapel,
                id: mapelJson[index].idKuis.toString(),
              );
            }),
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
                    "Nilai Kuis",
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
                        DataColumn(
                          label: Text(
                            "Kuis ke-",
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
                                DataCell(
                                  Text(element.urut),
                                ),
                                DataCell(
                                  Text(element.nilai.toString()),
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
