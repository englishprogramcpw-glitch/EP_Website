/**
 * =========================================================================
 * ไฟล์สำหรับแก้ไขข่าวสารและประกาศของเว็บไซต์ EP (สำหรับจำลองเป็นฐานข้อมูลข่าวสารแบบง่าย)
 * =========================================================================
 * วิธีการแก้ไขหรือเพิ่มข่าว:
 * 1. ข่าวแต่ละชิ้นจะอยู่ในเครื่องหมายปีกกา { ... } และคั่นด้วยเครื่องหมายจุลภาค (,)
 * 2. ข้อมูลที่ต้องกรอกมีดังนี้:
 *    - date: วันที่ประกาศ (เช่น "16/06/2026")
 *    - category: หมวดหมู่ (ให้เลือกใส่หนึ่งในสามคำนี้: "รับสมัครเรียน", "ผลงานนักเรียน", "กิจกรรม")
 *    - title: หัวข้อข่าวประกาศสำคัญ
 *    - content: รายละเอียดเนื้อหาข่าวสาร (สามารถเคาะขึ้นบรรทัดใหม่ยาวๆ ได้)
 *    - imageUrl: ลิงก์รูปภาพของข่าว (หาลิงก์ภาพจากอินเทอร์เน็ต หรือปล่อยว่างเป็น "" หากไม่มีรูป)
 * =========================================================================
 */

const ANNOUNCEMENTS_DATA = [
  {
    date: "16/06/2026",
    category: "รับสมัครเรียน",
    title: "ประกาศรับสมัครนักเรียนใหม่ ปีการศึกษา 2570",
    title_en: "Admission Announcement for New Students, Academic Year 2027",
    content: "เปิดรับสมัครนักเรียนเข้าศึกษาต่อในระดับชั้นประถมศึกษาปีที่ 1, มัธยมศึกษาปีที่ 1 และ 4 (โครงการฯ ภาคภาษาอังกฤษ English Program) ประจำปีการศึกษา 2570 สามารถติดต่อดาวน์โหลดใบสมัครและดูรายละเอียดกำหนดการได้ที่ห้องโครงการอาคาร 2",
    content_en: "Applications are now open for new students in Grade 1 (P.1), Grade 7 (M.1), and Grade 10 (M.4) for the English Program, Academic Year 2027. Application forms and scheduling details are available at the EP Office in Building 2.",
    imageUrl: "https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=800&auto=format&fit=crop&q=60"
  },
  {
    date: "12/06/2026",
    category: "ผลงานนักเรียน",
    title: "ขอแสดงความยินดีกับนักเรียนที่ได้คะแนน O-NET ภาษาอังกฤษเต็ม 100 คะแนน",
    title_en: "Congratulations to Students with Perfect O-NET English Scores (100/100)",
    content: "ทางหลักสูตร English Program ขอแสดงความชื่นชมและยินดีกับนักเรียนชั้นมัธยมศึกษาปีที่ 3 ที่สามารถทำคะแนนสอบวัดความรู้ระดับชาติ (O-NET) วิชาภาษาอังกฤษได้คะแนนเต็ม 100 คะแนนเต็มจำนวน 5 คนในปีนี้",
    content_en: "The English Program would like to congratulate our 5 Grade 9 (M.3) students who achieved a perfect score of 100 on the Ordinary National Educational Test (O-NET) in English this year.",
    imageUrl: "https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800&auto=format&fit=crop&q=60"
  },
  {
    date: "05/06/2026",
    category: "กิจกรรม",
    title: "ภาพบรรยากาศกิจกรรม EP English Camp 2026",
    title_en: "EP English Camp 2026 Activities Highlight",
    content: "รวมภาพกิจกรรมค่ายภาษาอังกฤษภาคฤดูร้อน ณ จังหวัดเชียงใหม่ เพื่อส่งเสริมทักษะการสื่อสารภาษาอังกฤษและการทำกิจกรรมกลุ่มร่วมกันของนักเรียนระดับชั้น ม.1 - ม.3 ประจำปีการศึกษา 2569",
    content_en: "Photo gallery of the Summer English Camp held in Chiang Mai to promote English communication and teamwork skills for Grade 7-9 students in Academic Year 2026.",
    imageUrl: "https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&auto=format&fit=crop&q=60"
  }
];
