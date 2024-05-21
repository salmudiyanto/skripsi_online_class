import 'dart:convert';
import 'dart:io';
import 'dart:typed_data';

import 'package:file_picker/file_picker.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smpn2parepare/const.dart';
import 'package:smpn2parepare/viewmodel/vm_jadwal.dart';
import 'package:smpn2parepare/viewmodel/vm_soal.dart';
import 'package:webview_flutter/webview_flutter.dart';
import 'package:http/http.dart' as http;

class TampilSoalKuis extends StatefulWidget {
  final String idSoal;
  const TampilSoalKuis({super.key, required this.idSoal});

  @override
  State<TampilSoalKuis> createState() => _TampilSoalKuisState();
}

class _TampilSoalKuisState extends State<TampilSoalKuis> {
  bool sudahpilih = false;
  late File _image;
  Uint8List? fileBytes;
  String? fileName;
  List<int>? baru;
  late final WebViewController controller;
  final _textController = TextEditingController();
  bool load = true;
  List aduanJson = [];
  int idSiswa = 0;

  Future _openFileExplorer() async {
    FilePickerResult? result = await FilePicker.platform.pickFiles(
        withData: true, type: FileType.custom, allowedExtensions: ['pdf']);
    if (result != null) {
      fileBytes = result.files.first.bytes;
      fileName = result.files.first.name;
      baru = new List.from(fileBytes!);
      setState(() {
        sudahpilih = true;
        _image = File(result.files.first.path.toString());
        // path = result.files.first.path;
      });
      print(result.files.first.size.toString());
      print("sini");
      print(baru);
    }
  }

  void getDataJadwal() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      // idSiswa = 11;
      idSiswa = prefs.getInt('idSiswa')!;
    });
    // SoalVM().getSoal(widget.idSoal).then((value) => null)
    SoalVM().getSoal(widget.idSoal).then((value) {
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
    controller = WebViewController()
      ..setJavaScriptMode(JavaScriptMode.unrestricted)
      ..setBackgroundColor(const Color(0x00000000))
      ..setNavigationDelegate(
        NavigationDelegate(
          onProgress: (int progress) {
            // Update loading bar.
          },
          onPageStarted: (String url) {},
          onPageFinished: (String url) {},
          onWebResourceError: (WebResourceError error) {},
          onNavigationRequest: (NavigationRequest request) {
            if (request.url.startsWith(
                '${VariableAPK.url2}tampilsoalkuis/${widget.idSoal}')) {
              return NavigationDecision.prevent;
            }
            return NavigationDecision.navigate;
          },
        ),
      )
      ..loadRequest(
          Uri.parse('${VariableAPK.url2}tampilsoalkuis/${widget.idSoal}'));
    // TODO: implement initState
    super.initState();
  }

  kirimText(BuildContext context) async {
    Fluttertoast.showToast(
        msg: "Mohon Tunggu...",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    final response = await http.post(
        Uri.parse("${VariableAPK.url}apikirimkuistext"),
        body: {"jawab": _textController.text, "idKuis": widget.idSoal});
    final data = jsonDecode(response.body);
    String stat = data['status'];
    Fluttertoast.showToast(
        msg: data['message'],
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    if (stat == "Ok") {
      Navigator.pop(context);
    } else {}
  }

  kirimFile(BuildContext context) async {
    Fluttertoast.showToast(
        msg: "Mohon Tunggu...",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    final response = await http
        .post(Uri.parse("${VariableAPK.url}apikirimkuisfile"), body: {
      "namafile": fileName,
      "file": base64Encode(baru!),
      "idKuis": widget.idSoal
    });
    final data = jsonDecode(response.body);
    String stat = data['status'];
    Fluttertoast.showToast(
        msg: data['message'],
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
    if (stat == "OK") {
      Navigator.pop(context);
    } else {}
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

    final response = await http.post(
        Uri.parse("http://mekanik-mks.balconteach.my.id/tambahprodukmekanik"),
        body: {
          // "namaproduk": _namaprodukController.text,
          // "hargaproduk": _hargaprodukController.text,
          // "stok": _stokprodukController.text,
          // "foto": base64Encode(baru!),
          // "deskripsi": _deskripsiprodukController.text,
          // "namafile": fileName,
          // "idmekanik": id.toString(),
        });

    final data = jsonDecode(response.body);
    String stat = data['status'];
    Fluttertoast.showToast(
            msg: data['message'],
            toastLength: Toast.LENGTH_SHORT,
            gravity: ToastGravity.BOTTOM,
            timeInSecForIosWeb: 1,
            backgroundColor: Colors.blueGrey,
            textColor: Colors.white,
            fontSize: 16.0)
        .whenComplete(() => Navigator.pop(context));
    // if (stat == "Ok") {
    //   ;
    // }
  }

  @override
  Widget build(BuildContext context) {
    var size = MediaQuery.of(context).size;
    return Scaffold(
      appBar: AppBar(title: const Text('Submit Jawaban')),
      body: Column(
        children: [
          Expanded(
            child: FractionallySizedBox(
                heightFactor: 0.3,
                child: WebViewWidget(controller: controller)),
          ),
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: Row(
              children: [
                Expanded(
                  child: ElevatedButton(
                    onPressed: () => {_openFileExplorer()},
                    child: const Text("File PDF"),
                  ),
                ),
                Expanded(
                  child: sudahpilih == true
                      ? Text(_image.toString())
                      : const Text("Submit File PDF"),
                ),
                Expanded(
                    child: IconButton(
                        onPressed: () {
                          if (baru != null) {
                            kirimFile(context);
                          }
                        },
                        icon: Icon(Icons.send)))
              ],
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: TextField(
              controller: _textController,
              decoration: InputDecoration(
                hintText: 'Enter text',
                suffixIcon: IconButton(
                  onPressed: () {
                    kirimText(context);
                  },
                  icon: Icon(Icons.send),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
