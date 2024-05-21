import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/viewmodel/vm_jadwal.dart';

class JadwalScreen extends StatefulWidget {
  const JadwalScreen({super.key});

  @override
  State<JadwalScreen> createState() => _JadwalScreenState();
}

class _JadwalScreenState extends State<JadwalScreen> {
  bool load = true;
  List aduanJson = [];
  int idSiswa = 0;

  void getDataJadwal() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      idSiswa = 11;
      // idSiswa = prefs.getInt('idSiswa')!;
    });
    JadwalVM().getJadwal(idSiswa.toString()).then((value) {
      setState(() {
        load = false;
        aduanJson = value;
        print(aduanJson);
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
    return load
        ? Center(
            child: CircularProgressIndicator(
              color: Colors.amber,
            ),
          )
        : SingleChildScrollView(
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
                    // margin: EdgeInsets.fromLTRB(20, 50, 20, 20),
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
                      ],
                      rows: aduanJson
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
