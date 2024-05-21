import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
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
    return load
        ? Center(
            child: CircularProgressIndicator(
              color: Colors.amber,
            ),
          )
        : Padding(
            padding: const EdgeInsets.fromLTRB(10, 30, 10, 10),
            child: Container(
              child: ListView.builder(
                  scrollDirection: Axis.vertical,
                  shrinkWrap: true,
                  itemCount: mapelJson == null ? 0 : mapelJson.length,
                  itemBuilder: (BuildContext context, int index) {
                    return MateriCard(
                      nomor: index + 1,
                      nama: mapelJson[index].namamapel,
                      id: mapelJson[index].idmapel.toString(),
                    );
                  }),
            ),
          );
  }
}
