import 'package:flutter/material.dart';
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/page/MateriDetail.dart';
import 'package:smpn2parepare/page/TampilSoal.dart';
import 'package:smpn2parepare/page/TugasList.dart';

class TugasCard extends StatelessWidget {
  final int nomor;
  final String id;
  final String nama;
  const TugasCard({
    Key? key,
    required this.nomor,
    required this.nama,
    required this.id,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 4.0,
      margin: new EdgeInsets.symmetric(horizontal: 5.0, vertical: 5.0),
      child: InkWell(
        onTap: () {
          Navigator.push(context,
              MaterialPageRoute(builder: (context) => TugasList(mapel: id)));
        },
        child: Container(
          decoration: BoxDecoration(color: VariableAPK.primaryColor),
          child: ListTile(
              contentPadding:
                  EdgeInsets.symmetric(horizontal: 5.0, vertical: 5.0),
              leading: Container(
                padding: EdgeInsets.only(right: 12.0),
                decoration: new BoxDecoration(
                    border: new Border(
                        right:
                            new BorderSide(width: 2.0, color: Colors.white))),
                child: Text("$nomor",
                    style: TextStyle(
                        color: Colors.white, fontWeight: FontWeight.bold)),
              ),
              title: Text(
                "$nama",
                style:
                    TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
              ),
              // subtitle: Text("Intermediate", style: TextStyle(color: Colors.white)),

              subtitle: Row(
                children: <Widget>[
                  // Icon(Icons.linear_scale, color: Colors.yellowAccent),
                  Text("Mata Pelajaran", style: TextStyle(color: Colors.white))
                ],
              ),
              trailing: Icon(Icons.keyboard_arrow_right,
                  color: Colors.white, size: 30.0)),
        ),
      ),
    );
  }
}
