import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/viewmodel/vm_essay.dart';
import 'package:smpn2parepare/viewmodel/vm_jadwal.dart';
import 'package:smpn2parepare/viewmodel/vm_soal.dart';
import 'package:smpn2parepare/widget/appbar.dart';
import 'package:smpn2parepare/widget/customCard.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:http/http.dart' as http;
import 'package:smpn2parepare/widget/ujianappbar.dart';

class SimpleMultipleChoice extends StatefulWidget {
  final String qrnya;
  const SimpleMultipleChoice({Key? key, required this.qrnya}) : super(key: key);

  @override
  _SimpleMultipleChoiceState createState() => _SimpleMultipleChoiceState();
}

class _SimpleMultipleChoiceState extends State<SimpleMultipleChoice> {
  bool load = true;
  List soalJson = [];
  List soalJsonessay = [];
  int idSiswa = 0;
  List<dynamic> _selectedAnswer = [];
  List<dynamic> _JawabanPG = [];
  List<dynamic> _essayAnswer = [];
  // int _selectedAnswer = -1;
  int benar = 0;
  int idUjian = 0;
  int? _radioSelected;
  String _radioVal = "";
  void getIDSiswa() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      // idSiswa = 11;
      idSiswa = prefs.getInt('idSiswa')!;
    });
  }

  _getIDUjian() async {
    Fluttertoast.showToast(
        msg: "Mohon Tunggu...",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    final response = await http.get(
        Uri.parse("${VariableAPK.url}apiidujian/${widget.qrnya}"),
        headers: {"Accept": "application/json"});
    // final response = await http.get(
    //     Uri.parse("${VariableAPK.url}apiidujian/${widget.qrnya}"),
    //     body: {"email": _emailControl.text, "password": _passControl.text});
    final data = jsonDecode(response.body);
    // String stat = data['status'];
    setState(() {
      idUjian = data['id'];
      print(idUjian);
    });
  }

  void getDataSoal() async {
    SoalVM().getSoal(widget.qrnya).then((value) {
      setState(() {
        load = false;
        soalJson = value;
        isisoal(soalJson);
        print(soalJson);
        print(widget.qrnya);
      });
    });
    EssayVM().getEssay(widget.qrnya).then((value) {
      setState(() {
        soalJsonessay = value;
        isisoal(soalJson);
        print(soalJson);
        print(widget.qrnya);
      });
    });
  }

  void isisoal(List isi) {
    isi.forEach((value) {
      _selectedAnswer.add(value.id);
      _JawabanPG.add(0);
    });
  }

  @override
  void initState() {
    getIDSiswa();
    getDataSoal();
    _getIDUjian();
    // TODO: implement initState
    super.initState();
  }

  Future _submit(BuildContext konteks) async {
    Fluttertoast.showToast(
        msg: "Mohon Tunggu...",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    final response = await http.get(
        Uri.parse("${VariableAPK.url}submitujian/$idUjian/$benar/$idSiswa"),
        headers: {"Accept": "application/json"});

    final data = jsonDecode(response.body);
    Fluttertoast.showToast(
        msg: data['message'],
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    Navigator.pop(context);
    // if (stat == "Ok") {
    //   ;
    // }
  }

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;

    return Scaffold(
      appBar: ujianAppbar(context, "Ujian"),
      body: load
          ? Center(
              child: CircularProgressIndicator(
                color: Colors.amber,
              ),
            )
          : Padding(
              padding: const EdgeInsets.fromLTRB(10, 30, 10, 10),
              child: Column(
                children: [
                  Container(
                    height: size.height * .75,
                    child: ListView.builder(
                        scrollDirection: Axis.vertical,
                        shrinkWrap: true,
                        itemCount: soalJson == null ? 0 : soalJson.length,
                        itemBuilder: (BuildContext context, int index) {
                          // _selectedAnswer.add(soalJson[index].id);
                          return Column(
                            mainAxisAlignment: MainAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                '${index + 1}. ${soalJson[index].soal}',
                                style: TextStyle(
                                    fontWeight: FontWeight.bold,
                                    fontSize: 18.0),
                              ),
                              Column(
                                mainAxisAlignment: MainAxisAlignment.start,
                                children: <Widget>[
                                  Row(
                                    children: [
                                      Radio(
                                        value: 1,
                                        groupValue: _selectedAnswer[index],
                                        onChanged: (value) {
                                          setState(() {
                                            if (soalJson[index].jawabanBenar ==
                                                'a') {
                                              benar++;
                                              _JawabanPG[index] = 1;
                                            } else {
                                              benar--;
                                              _JawabanPG[index] = 0;
                                            }
                                            print(benar);
                                          });
                                          _selectedAnswer[index] = value!;
                                        },
                                      ),
                                      Text('${soalJson[index].a}',
                                          style: TextStyle(
                                            fontSize: 12.0,
                                          )),
                                    ],
                                  ),
                                  Row(
                                    children: [
                                      Radio(
                                          value: 2,
                                          groupValue: _selectedAnswer[index],
                                          onChanged: (value) {
                                            setState(() {
                                              if (soalJson[index]
                                                      .jawabanBenar ==
                                                  'b') {
                                                benar++;
                                                _JawabanPG[index] = 1;
                                              } else {
                                                benar--;
                                                _JawabanPG[index] = 0;
                                              }
                                              print(benar);
                                            });
                                            _selectedAnswer[index] = value!;
                                          }),
                                      Text('${soalJson[index].b}',
                                          style: TextStyle(
                                            fontSize: 12.0,
                                          )),
                                    ],
                                  ),
                                  Row(
                                    children: [
                                      Radio(
                                          value: 3,
                                          groupValue: _selectedAnswer[index],
                                          onChanged: (value) {
                                            setState(() {
                                              if (soalJson[index]
                                                      .jawabanBenar ==
                                                  'c') {
                                                benar++;
                                                _JawabanPG[index] = 1;
                                              } else {
                                                benar--;
                                                _JawabanPG[index] = 0;
                                              }
                                              print(benar);
                                            });
                                            _selectedAnswer[index] = value!;
                                          }),
                                      Text('${soalJson[index].c}',
                                          style: TextStyle(
                                            fontSize: 12.0,
                                          )),
                                    ],
                                  ),
                                  Row(
                                    children: [
                                      Radio(
                                          value: 4,
                                          groupValue: _selectedAnswer[index],
                                          onChanged: (value) {
                                            setState(() {
                                              if (soalJson[index]
                                                      .jawabanBenar ==
                                                  'd') {
                                                benar++;
                                                _JawabanPG[index] = 1;
                                              } else {
                                                benar--;
                                                _JawabanPG[index] = 0;
                                              }
                                              print(benar);
                                            });
                                            _selectedAnswer[index] = value!;
                                          }),
                                      Text('${soalJson[index].d}',
                                          style: TextStyle(
                                            fontSize: 12.0,
                                          )),
                                    ],
                                  ),
                                ],
                              ),
                            ],
                          );
                        }),
                  ),
                  // Container(
                  //   child: Row(children: [
                  //     Row(
                  //       children: [
                  //         Radio(
                  //           value: 1,
                  //           groupValue: _radioSelected,
                  //           activeColor: Colors.blue,
                  //           onChanged: (value) {
                  //             setState(() {
                  //               _radioSelected = value as int;
                  //               _radioVal = 'Check In';
                  //               print(_radioVal);
                  //             });
                  //           },
                  //         ),
                  //         const Text("Check In"),
                  //       ],
                  //     ),
                  //     Row(
                  //       children: [
                  //         Radio(
                  //           value: 2,
                  //           groupValue: _radioSelected,
                  //           activeColor: Colors.red,
                  //           onChanged: (value) {
                  //             setState(() {
                  //               _radioSelected = value as int;
                  //               _radioVal = 'Check Out';
                  //               print(_radioVal);
                  //             });
                  //           },
                  //         ),
                  //         const Text("Check Out"),
                  //       ],
                  //     ),
                  //   ]),
                  // ),
                  Container(
                    child: ElevatedButton(
                      onPressed: () {
                        print(jsonEncode(_JawabanPG));
                        // _submit(context);
                      },
                      child: Text("Submit Ujian"),
                    ),
                  ),
                ],
              ),
            ),
    );
  }
}
