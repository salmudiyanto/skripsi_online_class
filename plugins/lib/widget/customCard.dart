import 'package:flutter/material.dart';
import 'package:smpn2parepare/page/MateriDetail.dart';

class MateriCard extends StatelessWidget {
  final int nomor;
  final String id;
  final String nama;
  const MateriCard({
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
          Navigator.push(
              context,
              MaterialPageRoute(
                  builder: (context) => MateriDetailScreen(
                        idMapel: id,
                        namaMapel: nama,
                      )));
        },
        child: Container(
          decoration: BoxDecoration(color: Color.fromRGBO(80, 177, 13, 0.9)),
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
                  Text("Materi", style: TextStyle(color: Colors.white))
                ],
              ),
              trailing: Icon(Icons.keyboard_arrow_right,
                  color: Colors.white, size: 30.0)),
        ),
      ),
    );
  }
}
