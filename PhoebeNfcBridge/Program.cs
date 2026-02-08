using System.IO.Ports;

Console.WriteLine("=== PHOEBE TECH CLUB: ACTIVE SCANNING MODE ===");

string portName = "COM5"; 
string tempPath = @"D:\Phoebe-Website\temp_uid.txt";

using SerialPort serialPort = new SerialPort(portName, 9600);
try {
    serialPort.Open();
    Console.WriteLine($"[OK] Dang ket noi tai {portName}. Hay quet the khi Web yeu cau.");
} catch (Exception ex) {
    Console.WriteLine($"Loi: {ex.Message}");
    return;
}

string lastUid = ""; 

while (true) {
    try {
        string rawData = serialPort.ReadLine().Trim();
        if (!string.IsNullOrEmpty(rawData)) {
            string uid = rawData.Contains(":") ? rawData.Split(':').Last().Trim() : rawData;
            uid = uid.Replace(" ", "").ToUpper();

            if (uid != lastUid) {
                // Tần số 1000Hz, kéo dài 200ms
                Console.Beep(1000, 200); 

                // 2. Ghi mã UID vào file cho Web
                using (StreamWriter sw = new StreamWriter(tempPath, false)) {
                    sw.Write(uid);
                    sw.Flush(); 
                }
                
                Console.WriteLine($"> Da nhan the moi: {uid}");
                lastUid = uid; 
                
                // 3. Đợi Web đọc file xong rồi xóa sạch (Tránh lỗi lặp thẻ)
                Thread.Sleep(1500); 
                File.WriteAllText(tempPath, ""); 
                
                Console.WriteLine("> Da reset file tam. San sang cho luot moi.");
                lastUid = ""; 
            }
        }
    } catch { }
    Thread.Sleep(100);
}