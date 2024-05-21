import 'dart:async';
import 'dart:io';

import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:smpn2parepare/widget/PDFViewer.dart';
import 'package:smpn2parepare/widget/appbar.dart';
import 'package:path_provider/path_provider.dart';

class MateriPdf extends StatefulWidget {
  final String url;
  const MateriPdf({super.key, required this.url});

  @override
  State<MateriPdf> createState() => _MateriPdfState();
}

class _MateriPdfState extends State<MateriPdf> {
  String remotePDFpath = "";
  @override
  void initState() {
    createFileOfPdfUrl().then((f) {
      setState(() {
        remotePDFpath = f.path;
      });
    });
    // TODO: implement initState
    super.initState();
  }

  Future<File> createFileOfPdfUrl() async {
    Completer<File> completer = Completer();
    print("Start download file from internet!");
    try {
      // "https://berlin2017.droidcon.cod.newthinking.net/sites/global.droidcon.cod.newthinking.net/files/media/documents/Flutter%20-%2060FPS%20UI%20of%20the%20future%20%20-%20DroidconDE%2017.pdf";
      // final url = "https://pdfkit.org/docs/guide.pdf";
      final url = widget.url;
      final filename = url.substring(url.lastIndexOf("/") + 1);
      var request = await HttpClient().getUrl(Uri.parse(url));
      var response = await request.close();
      var bytes = await consolidateHttpClientResponseBytes(response);
      var dir = await getApplicationDocumentsDirectory();
      print("Download files");
      print("${dir.path}/$filename");
      File file = File("${dir.path}/$filename");

      await file.writeAsBytes(bytes, flush: true);
      completer.complete(file);
    } catch (e) {
      throw Exception('Error parsing asset file!');
    }

    return completer.future;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: kosongAppbar(context, "File Materi"),
      body: Center(
          child: PDFViewer(
        url: remotePDFpath,
      )),
    );
  }
}
