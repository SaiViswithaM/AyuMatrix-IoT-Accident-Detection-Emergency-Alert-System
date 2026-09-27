import 'package:flutter_test/flutter_test.dart';
import 'package:ayumatrix_app/main.dart';

void main() {
  testWidgets(
    'AyuMatrix login screen loads',
    (WidgetTester tester) async {
      await tester.pumpWidget(
        const AyuMatrixApp(),
      );

      expect(
        find.text('AYUMATRIX'),
        findsOneWidget,
      );

      expect(
        find.text('LOGIN'),
        findsOneWidget,
      );

      expect(
        find.text('Create New Account'),
        findsOneWidget,
      );
    },
  );
}