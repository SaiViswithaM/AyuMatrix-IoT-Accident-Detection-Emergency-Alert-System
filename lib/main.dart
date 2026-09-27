import 'dart:async';

import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';

void main() {
  runApp(const AyuMatrixApp());
}

// ============================================================
// AYUMATRIX COLOUR PALETTE
// ============================================================

const Color ayuNavy = Color(0xFF071426);
const Color ayuDarkNavy = Color(0xFF0D1B2A);
const Color ayuCard = Color(0xFF12263D);

const Color ayuRed = Color(0xFFE53935);
const Color ayuGreen = Color(0xFF7BCB35);
const Color ayuBlue = Color(0xFF39B9FF);
const Color ayuLightBlue = Color(0xFF72D6FF);

const Color ayuWhite = Color(0xFFFFFFFF);
const Color ayuTextGray = Color(0xFFB8C4D0);

// ============================================================
// APP
// ============================================================

class AyuMatrixApp extends StatelessWidget {
  const AyuMatrixApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'AyuMatrix',

      theme: ThemeData(
        useMaterial3: true,
        scaffoldBackgroundColor: ayuNavy,
        fontFamily: 'Arial',

        colorScheme: const ColorScheme.dark(
          primary: ayuBlue,
          secondary: ayuGreen,
          error: ayuRed,
          surface: ayuCard,
        ),

        inputDecorationTheme: InputDecorationTheme(
          filled: true,
          fillColor: ayuDarkNavy,

          labelStyle: const TextStyle(
            color: ayuTextGray,
          ),

          hintStyle: const TextStyle(
            color: Colors.white54,
          ),

          prefixIconColor: ayuLightBlue,

          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: const BorderSide(
              color: Colors.white24,
            ),
          ),

          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: const BorderSide(
              color: ayuBlue,
              width: 2,
            ),
          ),

          errorBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: const BorderSide(
              color: ayuRed,
            ),
          ),

          focusedErrorBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: const BorderSide(
              color: ayuRed,
              width: 2,
            ),
          ),
        ),

        elevatedButtonTheme: ElevatedButtonThemeData(
          style: ElevatedButton.styleFrom(
            backgroundColor: ayuRed,
            foregroundColor: ayuWhite,

            minimumSize: const Size(
              double.infinity,
              52,
            ),

            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(12),
            ),

            textStyle: const TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
      ),

      home: const LoginPage(),
    );
  }
}

// ============================================================
// LOGIN PAGE
// ============================================================

class LoginPage extends StatefulWidget {
  const LoginPage({super.key});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final emailController = TextEditingController();
  final passwordController = TextEditingController();

  bool obscurePassword = true;

  @override
  void dispose() {
    emailController.dispose();
    passwordController.dispose();
    super.dispose();
  }

  // ==========================================================
  // LOGIN
  // ==========================================================

  void login() {
    final email = emailController.text.trim();
    final password = passwordController.text;

    if (email.isEmpty) {
      showMessage('Please enter your email.');
      return;
    }

    if (!_isValidEmail(email)) {
      showMessage('Please enter a valid email address.');
      return;
    }

    if (password.isEmpty) {
      showMessage('Please enter your password.');
      return;
    }

    // Temporary local login.
    // Real database authentication will be connected later.

    Navigator.pushReplacement(
      context,
      MaterialPageRoute(
        builder: (_) => const AyuMatrixDashboard(),
      ),
    );
  }

  bool _isValidEmail(String email) {
    return RegExp(
      r'^[^@\s]+@[^@\s]+\.[^@\s]+$',
    ).hasMatch(email);
  }

  void showMessage(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
      ),
    );
  }

  // ==========================================================
  // LOGIN UI
  // ==========================================================

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _background(
        child: SafeArea(
          child: Center(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(24),

              child: ConstrainedBox(
                constraints: const BoxConstraints(
                  maxWidth: 430,
                ),

                child: Card(
                  color: ayuCard,
                  elevation: 15,

                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(24),
                    side: const BorderSide(
                      color: Colors.white12,
                    ),
                  ),

                  child: Padding(
                    padding: const EdgeInsets.all(30),

                    child: Column(
                      children: [
                        _ayuLogo(),

                        const SizedBox(height: 20),

                        const Text(
                          'AYUMATRIX',
                          style: TextStyle(
                            fontSize: 30,
                            fontWeight: FontWeight.bold,
                            letterSpacing: 3,
                            color: ayuWhite,
                          ),
                        ),

                        const SizedBox(height: 8),

                        const Text(
                          'Smart Accident Detection &\n'
                          'Emergency Response System',
                          textAlign: TextAlign.center,
                          style: TextStyle(
                            fontSize: 14,
                            height: 1.5,
                            color: ayuTextGray,
                          ),
                        ),

                        const SizedBox(height: 35),

                        TextField(
                          controller: emailController,
                          keyboardType:
                              TextInputType.emailAddress,
                          style: const TextStyle(
                            color: ayuWhite,
                          ),
                          decoration: const InputDecoration(
                            labelText: 'Email',
                            hintText: 'Enter your email',
                            prefixIcon: Icon(
                              Icons.email_outlined,
                            ),
                          ),
                        ),

                        const SizedBox(height: 18),

                        TextField(
                          controller: passwordController,
                          obscureText: obscurePassword,
                          style: const TextStyle(
                            color: ayuWhite,
                          ),
                          decoration: InputDecoration(
                            labelText: 'Password',
                            hintText: 'Enter your password',

                            prefixIcon: const Icon(
                              Icons.lock_outline,
                            ),

                            suffixIcon: IconButton(
                              icon: Icon(
                                obscurePassword
                                    ? Icons.visibility_off
                                    : Icons.visibility,
                                color: ayuLightBlue,
                              ),

                              onPressed: () {
                                setState(() {
                                  obscurePassword =
                                      !obscurePassword;
                                });
                              },
                            ),
                          ),
                        ),

                        const SizedBox(height: 25),

                        SizedBox(
                          width: double.infinity,
                          height: 52,

                          child: ElevatedButton(
                            onPressed: login,
                            child: const Text('LOGIN'),
                          ),
                        ),

                        const SizedBox(height: 8),

                        TextButton(
                          onPressed: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                builder: (_) =>
                                    const RegistrationPage(),
                              ),
                            );
                          },

                          child: const Text(
                            'Create New Account',
                            style: TextStyle(
                              color: ayuLightBlue,
                              fontWeight: FontWeight.w600,
                            ),
                          ),
                        ),

                        const SizedBox(height: 15),

                        const Row(
                          mainAxisAlignment:
                              MainAxisAlignment.center,
                          children: [
                            Icon(
                              Icons.circle,
                              color: ayuGreen,
                              size: 9,
                            ),

                            SizedBox(width: 8),

                            Text(
                              'System Ready',
                              style: TextStyle(
                                color: ayuTextGray,
                                fontSize: 12,
                              ),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

// ============================================================
// REGISTRATION PAGE
// ============================================================

class RegistrationPage extends StatefulWidget {
  const RegistrationPage({super.key});

  @override
  State<RegistrationPage> createState() =>
      _RegistrationPageState();
}

class _RegistrationPageState
    extends State<RegistrationPage> {
  final nameController = TextEditingController();
  final emailController = TextEditingController();
  final phoneController = TextEditingController();
  final passwordController = TextEditingController();
  final confirmPasswordController =
      TextEditingController();

  bool obscurePassword = true;
  bool obscureConfirmPassword = true;

  @override
  void dispose() {
    nameController.dispose();
    emailController.dispose();
    phoneController.dispose();
    passwordController.dispose();
    confirmPasswordController.dispose();
    super.dispose();
  }

  // ==========================================================
  // REGISTRATION VALIDATION
  // ==========================================================

  void register() {
    final name = nameController.text.trim();
    final email = emailController.text.trim();
    final phone = phoneController.text.trim();
    final password = passwordController.text;
    final confirmPassword =
        confirmPasswordController.text;

    if (name.isEmpty) {
      showMessage('Please enter your name.');
      return;
    }

    if (email.isEmpty ||
        !_isValidEmail(email)) {
      showMessage(
        'Please enter a valid email address.',
      );
      return;
    }

    // Exactly 10 digits.
    if (!RegExp(r'^[0-9]{10}$').hasMatch(phone)) {
      showMessage(
        'Phone number must contain exactly 10 digits.',
      );
      return;
    }

    if (!_isStrongPassword(password)) {
      showMessage(
        'Password must be at least 8 characters and '
        'include uppercase, lowercase, number and special character.',
      );
      return;
    }

    if (password != confirmPassword) {
      showMessage(
        'Passwords do not match.',
      );
      return;
    }

    // ========================================================
    // IMPORTANT
    // ========================================================
    //
    // This currently validates the registration form only.
    //
    // Later we will connect:
    //
    // Flutter → PHP API → MySQL
    //
    // That backend will check whether the email/phone
    // already exists.
    // ========================================================

    showMessage(
      'Registration details are valid.',
    );

    Navigator.pop(context);
  }

  bool _isValidEmail(String email) {
    return RegExp(
      r'^[^@\s]+@[^@\s]+\.[^@\s]+$',
    ).hasMatch(email);
  }

  bool _isStrongPassword(String password) {
    if (password.length < 8) {
      return false;
    }

    final hasUppercase =
        RegExp(r'[A-Z]').hasMatch(password);

    final hasLowercase =
        RegExp(r'[a-z]').hasMatch(password);

    final hasNumber =
        RegExp(r'[0-9]').hasMatch(password);

    final hasSpecial =
        RegExp(r'[!@#$%^&*(),.?":{}|<>_\-]')
            .hasMatch(password);

    return hasUppercase &&
        hasLowercase &&
        hasNumber &&
        hasSpecial;
  }

  void showMessage(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
      ),
    );
  }

  // ==========================================================
  // REGISTRATION UI
  // ==========================================================

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: ayuDarkNavy,
        foregroundColor: ayuWhite,
        title: const Text('Create Account'),
      ),

      body: _background(
        child: SafeArea(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(24),

            child: Center(
              child: ConstrainedBox(
                constraints: const BoxConstraints(
                  maxWidth: 430,
                ),

                child: Card(
                  color: ayuCard,

                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(24),
                  ),

                  child: Padding(
                    padding: const EdgeInsets.all(25),

                    child: Column(
                      children: [
                        const Icon(
                          Icons.person_add_alt_1,
                          color: ayuGreen,
                          size: 60,
                        ),

                        const SizedBox(height: 15),

                        const Text(
                          'Register for AyuMatrix',
                          style: TextStyle(
                            color: ayuWhite,
                            fontSize: 24,
                            fontWeight: FontWeight.bold,
                          ),
                        ),

                        const SizedBox(height: 25),

                        TextField(
                          controller: nameController,
                          textCapitalization:
                              TextCapitalization.words,
                          style: const TextStyle(
                            color: ayuWhite,
                          ),
                          decoration: const InputDecoration(
                            labelText: 'Full Name',
                            hintText:
                                'Enter your full name',
                            prefixIcon: Icon(
                              Icons.person_outline,
                            ),
                          ),
                        ),

                        const SizedBox(height: 16),

                        TextField(
                          controller: emailController,
                          keyboardType:
                              TextInputType.emailAddress,
                          style: const TextStyle(
                            color: ayuWhite,
                          ),
                          decoration: const InputDecoration(
                            labelText: 'Email',
                            hintText:
                                'example@gmail.com',
                            prefixIcon: Icon(
                              Icons.email_outlined,
                            ),
                          ),
                        ),

                        const SizedBox(height: 16),

                        TextField(
                          controller: phoneController,
                          keyboardType:
                              TextInputType.phone,
                          maxLength: 10,
                          style: const TextStyle(
                            color: ayuWhite,
                          ),
                          decoration: const InputDecoration(
                            labelText:
                                'Phone Number',
                            hintText:
                                '10 digit mobile number',
                            prefixIcon: Icon(
                              Icons.phone_outlined,
                            ),
                            counterText: '',
                          ),
                        ),

                        const SizedBox(height: 16),

                        TextField(
                          controller:
                              passwordController,
                          obscureText: obscurePassword,
                          style: const TextStyle(
                            color: ayuWhite,
                          ),
                          decoration: InputDecoration(
                            labelText: 'Password',
                            hintText:
                                'Create a strong password',

                            prefixIcon: const Icon(
                              Icons.lock_outline,
                            ),

                            suffixIcon: IconButton(
                              icon: Icon(
                                obscurePassword
                                    ? Icons.visibility_off
                                    : Icons.visibility,
                                color: ayuLightBlue,
                              ),

                              onPressed: () {
                                setState(() {
                                  obscurePassword =
                                      !obscurePassword;
                                });
                              },
                            ),
                          ),
                        ),

                        const SizedBox(height: 16),

                        TextField(
                          controller:
                              confirmPasswordController,
                          obscureText:
                              obscureConfirmPassword,
                          style: const TextStyle(
                            color: ayuWhite,
                          ),
                          decoration: InputDecoration(
                            labelText:
                                'Confirm Password',

                            prefixIcon: const Icon(
                              Icons.lock_reset,
                            ),

                            suffixIcon: IconButton(
                              icon: Icon(
                                obscureConfirmPassword
                                    ? Icons.visibility_off
                                    : Icons.visibility,
                                color: ayuLightBlue,
                              ),

                              onPressed: () {
                                setState(() {
                                  obscureConfirmPassword =
                                      !obscureConfirmPassword;
                                });
                              },
                            ),
                          ),
                        ),

                        const SizedBox(height: 25),

                        SizedBox(
                          width: double.infinity,
                          height: 52,

                          child: ElevatedButton(
                            onPressed: register,
                            child: const Text(
                              'CREATE ACCOUNT',
                            ),
                          ),
                        ),

                        const SizedBox(height: 12),

                        const Row(
                          mainAxisAlignment:
                              MainAxisAlignment.center,
                          children: [
                            Icon(
                              Icons.shield_outlined,
                              color: ayuGreen,
                              size: 18,
                            ),

                            SizedBox(width: 8),

                            Flexible(
                              child: Text(
                                'Your safety. Our priority.',
                                textAlign: TextAlign.center,
                                style: TextStyle(
                                  color: ayuTextGray,
                                  fontSize: 12,
                                ),
                              ),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

// ============================================================
// DASHBOARD
// ============================================================

class AyuMatrixDashboard extends StatefulWidget {
  const AyuMatrixDashboard({super.key});

  @override
  State<AyuMatrixDashboard> createState() =>
      _AyuMatrixDashboardState();
}

class _AyuMatrixDashboardState
    extends State<AyuMatrixDashboard> {
  Position? currentPosition;

  StreamSubscription<Position>?
      positionSubscription;

  bool isLoadingLocation = false;
  bool isLiveLocation = false;

  String locationStatus =
      'Location not loaded';

  @override
  void dispose() {
    positionSubscription?.cancel();
    super.dispose();
  }

  // ==========================================================
  // LOCATION SERVICE
  // ==========================================================

  Future<bool> checkLocationService() async {
    final enabled =
        await Geolocator.isLocationServiceEnabled();

    if (!enabled) {
      if (mounted) {
        showMessage(
          'Please turn on GPS/Location on your phone.',
        );
      }

      return false;
    }

    return true;
  }

  // ==========================================================
  // LOCATION PERMISSION
  // ==========================================================

  Future<bool> requestLocationPermission() async {
    var permission =
        await Geolocator.checkPermission();

    if (permission ==
        LocationPermission.denied) {
      permission =
          await Geolocator.requestPermission();
    }

    if (permission ==
        LocationPermission.denied) {
      if (mounted) {
        showMessage(
          'Location permission was denied.',
        );
      }

      return false;
    }

    if (permission ==
        LocationPermission.deniedForever) {
      if (mounted) {
        showMessage(
          'Location permission is permanently denied. '
          'Enable it from Android Settings.',
        );
      }

      return false;
    }

    return true;
  }

  // ==========================================================
  // GET CURRENT LOCATION
  // ==========================================================

  Future<void> getCurrentLocation() async {
    setState(() {
      isLoadingLocation = true;
      locationStatus =
          'Getting GPS location...';
    });

    try {
      if (!await checkLocationService()) {
        setState(() {
          isLoadingLocation = false;
          locationStatus =
              'GPS is disabled';
        });

        return;
      }

      if (!await requestLocationPermission()) {
        setState(() {
          isLoadingLocation = false;
          locationStatus =
              'Location permission unavailable';
        });

        return;
      }

      final position =
          await Geolocator.getCurrentPosition(
        locationSettings:
            const LocationSettings(
          accuracy: LocationAccuracy.high,
        ),
      );

      if (!mounted) return;

      setState(() {
        currentPosition = position;
        isLoadingLocation = false;
        locationStatus =
            'Location received successfully';
      });
    } catch (e) {
      if (!mounted) return;

      setState(() {
        isLoadingLocation = false;
        locationStatus =
            'Unable to get GPS location';
      });

      showMessage(
        'GPS error: $e',
      );
    }
  }

  // ==========================================================
  // START LIVE GPS
  // ==========================================================

  Future<void> startLiveLocation() async {
    if (!await checkLocationService()) {
      return;
    }

    if (!await requestLocationPermission()) {
      return;
    }

    await positionSubscription?.cancel();

    const settings = LocationSettings(
      accuracy: LocationAccuracy.high,
      distanceFilter: 5,
    );

    positionSubscription =
        Geolocator.getPositionStream(
      locationSettings: settings,
    ).listen(
      (Position position) {
        if (!mounted) return;

        setState(() {
          currentPosition = position;
          locationStatus =
              'Live location active';
        });
      },
      onError: (error) {
        if (!mounted) return;

        setState(() {
          locationStatus =
              'Live GPS error';
        });
      },
    );

    setState(() {
      isLiveLocation = true;
      locationStatus =
          'Waiting for GPS updates...';
    });
  }

  // ==========================================================
  // STOP LIVE GPS
  // ==========================================================

  Future<void> stopLiveLocation() async {
    await positionSubscription?.cancel();

    positionSubscription = null;

    if (!mounted) return;

    setState(() {
      isLiveLocation = false;

      locationStatus = currentPosition == null
          ? 'Live location stopped'
          : 'Location available';
    });
  }

  // ==========================================================
  // TOGGLE GPS
  // ==========================================================

  Future<void> toggleLiveLocation(
    bool enabled,
  ) async {
    if (enabled) {
      await startLiveLocation();
    } else {
      await stopLiveLocation();
    }
  }

  // ==========================================================
  // DASHBOARD
  // ==========================================================

  @override
  Widget build(BuildContext context) {
    final position = currentPosition;

    return Scaffold(
      backgroundColor: ayuNavy,

      appBar: AppBar(
        backgroundColor: ayuDarkNavy,
        foregroundColor: ayuWhite,
        title: const Text(
          'AYUMATRIX',
          style: TextStyle(
            fontWeight: FontWeight.bold,
            letterSpacing: 2,
          ),
        ),

        actions: [
          IconButton(
            tooltip: 'Logout',

            icon: const Icon(
              Icons.logout,
            ),

            onPressed: () async {
              await stopLiveLocation();

              if (!context.mounted) return;

              Navigator.pushAndRemoveUntil(
                context,
                MaterialPageRoute(
                  builder: (_) =>
                      const LoginPage(),
                ),
                (_) => false,
              );
            },
          ),
        ],
      ),

      body: _background(
        child: SafeArea(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(20),

            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,

              children: [
                const Text(
                  'Emergency Dashboard',
                  style: TextStyle(
                    color: ayuWhite,
                    fontSize: 26,
                    fontWeight: FontWeight.bold,
                  ),
                ),

                const SizedBox(height: 8),

                const Text(
                  'Your safety. Our priority.',
                  style: TextStyle(
                    color: ayuTextGray,
                  ),
                ),

                const SizedBox(height: 22),

                // ==================================================
                // SYSTEM STATUS
                // ==================================================

                Card(
                  color: ayuCard,

                  child: const Padding(
                    padding: EdgeInsets.all(18),

                    child: Row(
                      children: [
                        Icon(
                          Icons.circle,
                          color: ayuGreen,
                          size: 12,
                        ),

                        SizedBox(width: 12),

                        Expanded(
                          child: Text(
                            'AyuMatrix system ready',
                            style: TextStyle(
                              color: ayuWhite,
                              fontWeight:
                                  FontWeight.w600,
                            ),
                          ),
                        ),

                        Icon(
                          Icons.shield_outlined,
                          color: ayuGreen,
                        ),
                      ],
                    ),
                  ),
                ),

                const SizedBox(height: 20),

                // ==================================================
                // GPS CARD
                // ==================================================

                Card(
                  color: ayuCard,

                  shape:
                      RoundedRectangleBorder(
                    borderRadius:
                        BorderRadius.circular(20),
                  ),

                  child: Padding(
                    padding: const EdgeInsets.all(20),

                    child: Column(
                      crossAxisAlignment:
                          CrossAxisAlignment.start,

                      children: [
                        Row(
                          children: [
                            const Icon(
                              Icons.location_on,
                              color: ayuBlue,
                              size: 32,
                            ),

                            const SizedBox(width: 12),

                            const Expanded(
                              child: Text(
                                'Live Location',
                                style: TextStyle(
                                  color: ayuWhite,
                                  fontSize: 20,
                                  fontWeight:
                                      FontWeight.bold,
                                ),
                              ),
                            ),

                            if (isLiveLocation)
                              const Row(
                                children: [
                                  Icon(
                                    Icons.circle,
                                    color: ayuGreen,
                                    size: 9,
                                  ),
                                  SizedBox(width: 5),
                                  Text(
                                    'LIVE',
                                    style: TextStyle(
                                      color: ayuGreen,
                                      fontSize: 11,
                                      fontWeight:
                                          FontWeight.bold,
                                    ),
                                  ),
                                ],
                              ),
                          ],
                        ),

                        const SizedBox(height: 18),

                        Text(
                          locationStatus,
                          style: const TextStyle(
                            color: ayuTextGray,
                            fontSize: 13,
                          ),
                        ),

                        const SizedBox(height: 18),

                        Container(
                          width: double.infinity,
                          padding:
                              const EdgeInsets.all(16),

                          decoration:
                              BoxDecoration(
                            color: ayuDarkNavy,
                            borderRadius:
                                BorderRadius.circular(14),
                          ),

                          child: position == null
                              ? const Column(
                                  children: [
                                    Icon(
                                      Icons.gps_off,
                                      color:
                                          ayuTextGray,
                                      size: 40,
                                    ),

                                    SizedBox(height: 8),

                                    Text(
                                      'No GPS location yet',
                                      style: TextStyle(
                                        color:
                                            ayuTextGray,
                                      ),
                                    ),
                                  ],
                                )
                              : Column(
                                  children: [
                                    _coordinate(
                                      'Latitude',
                                      position.latitude
                                          .toStringAsFixed(
                                              6),
                                    ),

                                    const Divider(
                                      color:
                                          Colors.white12,
                                    ),

                                    _coordinate(
                                      'Longitude',
                                      position.longitude
                                          .toStringAsFixed(
                                              6),
                                    ),

                                    const Divider(
                                      color:
                                          Colors.white12,
                                    ),

                                    _coordinate(
                                      'Accuracy',
                                      '${position.accuracy.toStringAsFixed(1)} m',
                                    ),
                                  ],
                                ),
                        ),

                        const SizedBox(height: 18),

                        SizedBox(
                          width: double.infinity,

                          child: OutlinedButton.icon(
                            onPressed:
                                isLoadingLocation
                                    ? null
                                    : getCurrentLocation,

                            icon: isLoadingLocation
                                ? const SizedBox(
                                    width: 18,
                                    height: 18,
                                    child:
                                        CircularProgressIndicator(
                                      strokeWidth: 2,
                                      color: ayuBlue,
                                    ),
                                  )
                                : const Icon(
                                    Icons.my_location,
                                  ),

                            label: Text(
                              isLoadingLocation
                                  ? 'Getting Location...'
                                  : 'Get Current Location',
                            ),

                            style:
                                OutlinedButton.styleFrom(
                              foregroundColor:
                                  ayuBlue,

                              side:
                                  const BorderSide(
                                color: ayuBlue,
                              ),

                              minimumSize:
                                  const Size(
                                double.infinity,
                                50,
                              ),
                            ),
                          ),
                        ),

                        const SizedBox(height: 12),

                        SwitchListTile(
                          contentPadding:
                              EdgeInsets.zero,

                          title: const Text(
                            'Continuous Live Location',
                            style: TextStyle(
                              color: ayuWhite,
                              fontWeight:
                                  FontWeight.w600,
                            ),
                          ),

                          subtitle: const Text(
                            'Update GPS while using AyuMatrix',
                            style: TextStyle(
                              color: ayuTextGray,
                              fontSize: 12,
                            ),
                          ),

                          value: isLiveLocation,

                          activeThumbColor:
                              ayuGreen,

                          onChanged:
                              toggleLiveLocation,
                        ),
                      ],
                    ),
                  ),
                ),

                const SizedBox(height: 20),

                // ==================================================
                // SENSOR PLACEHOLDER
                // ==================================================

                Card(
                  color: ayuCard,

                  child: const Padding(
                    padding: EdgeInsets.all(20),

                    child: Row(
                      children: [
                        Icon(
                          Icons.sensors_outlined,
                          color: ayuLightBlue,
                          size: 34,
                        ),

                        SizedBox(width: 15),

                        Expanded(
                          child: Column(
                            crossAxisAlignment:
                                CrossAxisAlignment.start,

                            children: [
                              Text(
                                'Sensor Integration',
                                style: TextStyle(
                                  color: ayuWhite,
                                  fontSize: 17,
                                  fontWeight:
                                      FontWeight.bold,
                                ),
                              ),

                              SizedBox(height: 5),

                              Text(
                                'Hardware sensors will be '
                                'connected here later.',
                                style: TextStyle(
                                  color: ayuTextGray,
                                  fontSize: 12,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),
                ),

                const SizedBox(height: 30),

                const Center(
                  child: Text(
                    'AYUMATRIX • Smart Emergency Response',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      color: ayuTextGray,
                      fontSize: 11,
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  // ==========================================================
  // COORDINATE
  // ==========================================================

  Widget _coordinate(
    String title,
    String value,
  ) {
    return Padding(
      padding: const EdgeInsets.symmetric(
        vertical: 5,
      ),

      child: Row(
        children: [
          Expanded(
            child: Text(
              title,
              style: const TextStyle(
                color: ayuTextGray,
              ),
            ),
          ),

          Text(
            value,
            style: const TextStyle(
              color: ayuWhite,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }

  // ==========================================================
  // MESSAGE
  // ==========================================================

  void showMessage(String message) {
    if (!mounted) return;

    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
      ),
    );
  }
}

// ============================================================
// BACKGROUND
// ============================================================

Widget _background({
  required Widget child,
}) {
  return Container(
    width: double.infinity,
    height: double.infinity,

    decoration: const BoxDecoration(
      gradient: LinearGradient(
        begin: Alignment.topLeft,
        end: Alignment.bottomRight,

        colors: [
          ayuNavy,
          ayuDarkNavy,
          Color(0xFF163653),
        ],
      ),
    ),

    child: child,
  );
}

// ============================================================
// AYUMATRIX LOGO
// ============================================================

Widget _ayuLogo() {
  return Container(
    width: 100,
    height: 100,

    decoration: BoxDecoration(
      shape: BoxShape.circle,
      color: ayuDarkNavy,

      border: Border.all(
        color: ayuBlue,
        width: 2,
      ),
    ),

    child: const Icon(
      Icons.health_and_safety,
      size: 60,
      color: ayuGreen,
    ),
  );
}