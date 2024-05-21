import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/viewmodel/vm_mapel.dart';
import 'package:smpn2parepare/widget/customCard.dart';

class KuisScreen extends StatefulWidget {
  const KuisScreen({super.key});

  @override
  State<KuisScreen> createState() => KuisScreenState();
}

class KuisScreenState extends State<KuisScreen> {
  bool load = true;
  List mapelJson = [];
  int idSiswa = 0;
  void getDataJadwal() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      idSiswa = 11;
      // idSiswa = prefs.getInt('idSiswa')!;
    });
    MapelVM().getMapel(idSiswa.toString()).then((value) {
      setState(() {
        mapelJson = value;
        print(mapelJson);
        load = false;
      });
    });
  }

  @override
  void initState() {
    getDataJadwal();
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
        : SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: Container(
              decoration: const BoxDecoration(
                  // color: Colors.red.withOpacity(0.1),
                  image: DecorationImage(
                      image: AssetImage("assets/bg.jpg"),
                      fit: BoxFit.cover,
                      opacity: 0.2)),
              child: Padding(
                padding: EdgeInsets.fromLTRB(0, 50, 0, 0),
                child: Column(
                  children: [
                    Text(
                      "Jadwal Pelajaran",
                      style: TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                          decoration: TextDecoration.underline),
                    ),
                    Container(
                      // width: size.width * 0.6,
                      // margin: EdgeInsets.fromLTRB(5, 5, 5, 5),
                      child: DataTable(
                        columns: <DataColumn>[
                          DataColumn(
                            label: Text(
                              "Hari",
                              style: TextStyle(fontWeight: FontWeight.bold),
                            ),
                          ),
                          DataColumn(
                            label: Text(
                              "Mapel",
                              style: TextStyle(fontWeight: FontWeight.bold),
                            ),
                          ),
                          DataColumn(
                            label: Text(
                              "Jam Pelajaran",
                              style: TextStyle(fontWeight: FontWeight.bold),
                            ),
                          ),
                          DataColumn(
                            label: Text(
                              "Tugas",
                              style: TextStyle(fontWeight: FontWeight.bold),
                            ),
                          ),
                        ],
                        rows: mapelJson
                            .map((element) => DataRow(cells: <DataCell>[
                                  DataCell(
                                    Text(element.hari),
                                  ),
                                  DataCell(
                                    Text(element.namamapel),
                                  ),
                                  DataCell(
                                    Text(element.jampelajaran),
                                  ),
                                  DataCell(
                                    InkWell(onTap: () {}, child: Text("Tugas")),
                                  ),
                                ]))
                            .toList(),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          );
  }
}
