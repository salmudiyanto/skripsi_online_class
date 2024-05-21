import 'package:flutter/material.dart';
import 'package:flutter_pdfview/flutter_pdfview.dart';

class PDFViewer extends StatelessWidget {
  final String url;
  const PDFViewer({super.key, required this.url});

  @override
  Widget build(BuildContext context) {
    return PDFView(
      filePath: url,
      enableSwipe: true,
      swipeHorizontal: true,
      autoSpacing: false,
      pageFling: true,
      onRender: (_pages) {
        print("Rendered $_pages pages.");
      },
      onError: (error) {
        print(error.toString());
      },
      onPageError: (page, error) {
        print('$page: ${error.toString()}');
      },
      onViewCreated: (PDFViewController pdfViewController) {
        // set the controller
      },
      onPageChanged: (int? page, int? total) {
        print('page change: $page/$total');
      },
    );
  }
}
