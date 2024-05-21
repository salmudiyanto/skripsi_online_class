import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/viewmodel/vm_mapel.dart';
import 'package:smpn2parepare/viewmodel/vm_materi.dart';
import 'package:smpn2parepare/widget/appbar.dart';
import 'package:smpn2parepare/widget/customCard.dart';
import 'package:smpn2parepare/widget/materiCard.dart';

class MateriDetailScreen extends StatefulWidget {
  final String idMapel;
  final String namaMapel;
  const MateriDetailScreen(
      {super.key, required this.idMapel, required this.namaMapel});

  @override
  State<MateriDetailScreen> createState() => _MateriDetailScreenState();
}

class _MateriDetailScreenState extends State<MateriDetailScreen> {
  bool load = true;
  List mapelJson = [];
  int idSiswa = 0;
  void getDataMateri() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      // idSiswa = 11;
      idSiswa = prefs.getInt('idSiswa')!;
    });
    MateriVM()
        .getMateri(widget.idMapel.toString(), idSiswa.toString())
        .then((value) {
      setState(() {
        load = false;
        mapelJson = value;
        print(mapelJson);
      });
    });
  }

  @override
  void initState() {
    getDataMateri();
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: kosongAppbar(context, widget.namaMapel),
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
                      opacity: 0.2)),
              child: Padding(
                padding: const EdgeInsets.fromLTRB(10, 30, 10, 10),
                child: Container(
                  child: ListView.builder(
                      scrollDirection: Axis.vertical,
                      shrinkWrap: true,
                      itemCount: mapelJson == null ? 0 : mapelJson.length,
                      itemBuilder: (BuildContext context, int index) {
                        return MateriCardPdf(
                          nomor: index + 1,
                          nama: mapelJson[index].judul,
                          id: mapelJson[index].id.toString(),
                          url:
                              "${VariableAPK.url}filemateri/${mapelJson[index].file}",
                        );
                      }),
                ),
              ),
            ),
    );
  }
}
