import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/customButton.dart';
import 'package:smpn2parepare/viewmodel/vm_mapel.dart';
import 'package:smpn2parepare/widget/customCard.dart';

class TugasScreen extends StatefulWidget {
  const TugasScreen({super.key});

  @override
  State<TugasScreen> createState() => TugasScreenState();
}

class TugasScreenState extends State<TugasScreen> {
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
          );
  }
}
