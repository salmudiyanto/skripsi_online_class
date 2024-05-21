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
  List<TextEditingController> _controller = [];
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
        isiessay(soalJsonessay);
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

  void isiessay(List isi) {
    isi.forEach((value) {
      _essayAnswer.add('');
      _controller.add(TextEditingController());
    });
  }

  @override
  void dispose() {
    // TODO: implement dispose
    for (TextEditingController controller in _controller) {
      controller.dispose();
    }
    super.dispose();
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
    int nomor = 0;
    // print(jsonEncode(_JawabanPG));
    for (TextEditingController controller in _controller) {
      _essayAnswer[nomor++] = controller.text;
    }
    // print(jsonEncode(_essayAnswer));
    Fluttertoast.showToast(
        msg: "Mohon Tunggu...",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    try {
      http.Response hasil =
          await http.post(Uri.parse("${VariableAPK.url}submitujian"), body: {
        "idUjian": idUjian.toString(),
        "idSiswa": idSiswa.toString(),
        'PG': jsonEncode(_JawabanPG),
        'Essay': jsonEncode(_essayAnswer)
      });
      print({
        "idUjian": idUjian.toString(),
        "idSiswa": idSiswa.toString(),
        'PG': jsonEncode(_JawabanPG),
        'Essay': jsonEncode(_essayAnswer)
      });
      if (hasil.statusCode == 200) {
        final data = await jsonDecode(hasil.body);
        print("data category success");
        print(hasil.body);
        Fluttertoast.showToast(
            msg: data['message'],
            toastLength: Toast.LENGTH_SHORT,
            gravity: ToastGravity.BOTTOM,
            timeInSecForIosWeb: 1,
            backgroundColor: Colors.blueGrey,
            textColor: Colors.white,
            fontSize: 16.0);
        if (data['status'] == 'Ok') {
          Navigator.pop(context);
        }
      } else {
        print("error status " + hasil.statusCode.toString());
        Fluttertoast.showToast(
            msg: "Gagal Menghubungkan",
            toastLength: Toast.LENGTH_SHORT,
            gravity: ToastGravity.BOTTOM,
            timeInSecForIosWeb: 1,
            backgroundColor: Colors.blueGrey,
            textColor: Colors.white,
            fontSize: 16.0);
      }
    } catch (e) {
      Fluttertoast.showToast(
          msg: "Gagal Menghubungkan",
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.BOTTOM,
          timeInSecForIosWeb: 1,
          backgroundColor: Colors.blueGrey,
          textColor: Colors.white,
          fontSize: 16.0);
    }
  }

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;

    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          actions: [
            InkWell(
              onTap: () {
                _submit(context);
              },
              child: Padding(
                padding: EdgeInsets.symmetric(horizontal: 16.0),
                child: Center(
                  child: Text(
                    'Submit',
                    style: TextStyle(
                      fontSize: 18.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ),
            ),
          ],
          title: Text('Ujian'),
          bottom: TabBar(
            tabs: [
              Tab(
                text: 'Pilihan Ganda',
              ),
              Tab(
                text: 'Essay',
              ),
            ],
          ),
        ),
        body: load
            ? Center(
                child: CircularProgressIndicator(
                  color: Colors.amber,
                ),
              )
            : TabBarView(
                children: [
                  Padding(
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
                                      mainAxisAlignment:
                                          MainAxisAlignment.start,
                                      children: <Widget>[
                                        Row(
                                          children: [
                                            Radio(
                                              value: 1,
                                              groupValue:
                                                  _selectedAnswer[index],
                                              onChanged: (value) {
                                                setState(() {
                                                  if (soalJson[index]
                                                          .jawabanBenar ==
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
                                                groupValue:
                                                    _selectedAnswer[index],
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
                                                  _selectedAnswer[index] =
                                                      value!;
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
                                                groupValue:
                                                    _selectedAnswer[index],
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
                                                  _selectedAnswer[index] =
                                                      value!;
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
                                                groupValue:
                                                    _selectedAnswer[index],
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
                                                  _selectedAnswer[index] =
                                                      value!;
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
                      ],
                    ),
                  ),
                  // Konten untuk Tab 2
                  Container(
                    child: Padding(
                      padding: const EdgeInsets.fromLTRB(10, 30, 10, 10),
                      child: SingleChildScrollView(
                        scrollDirection: Axis.vertical,
                        child: Column(children: [
                          Container(
                              height: size.height * .75,
                              child: ListView.builder(
                                  scrollDirection: Axis.vertical,
                                  shrinkWrap: true,
                                  itemCount: soalJsonessay == null
                                      ? 0
                                      : soalJsonessay.length,
                                  itemBuilder:
                                      (BuildContext context, int index) {
                                    return Column(
                                        mainAxisAlignment:
                                            MainAxisAlignment.start,
                                        children: <Widget>[
                                          Text(
                                            '${index + 1}. ${soalJsonessay[index].soal}',
                                            style: TextStyle(
                                                fontWeight: FontWeight.bold,
                                                fontSize: 18.0),
                                          ),
                                          TextField(
                                            controller: _controller[index],
                                            maxLines: 5,
                                            decoration: InputDecoration(
                                              hintText:
                                                  'Masukkan Jawaban disini',
                                            ),
                                          ),
                                        ]);
                                  })),
                        ]),
                      ),
                    ),
                  ),
                ],
              ),
      ),
    );
  }
}
