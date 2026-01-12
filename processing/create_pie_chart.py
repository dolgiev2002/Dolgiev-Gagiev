import sys
import json
import matplotlib.pyplot as plt
import io

def create_pie_chart(data):
    labels = data.keys()
    sizes = data.values()

    fig, ax = plt.subplots()
    ax.pie(sizes, labels=labels, autopct='%1.1f%%', startangle=90)
    ax.axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.

    buf = io.BytesIO()
    plt.savefig(buf, format='png')
    buf.seek(0)
    return buf.getvalue()

if __name__ == "__main__":
    # Получаем данные из аргумента командной строки
    json_data = sys.argv[1]
    data = json.loads(json_data)

    # Создаем круговую диаграмму
    image_data = create_pie_chart(data)

    # Отправляем изображение в stdout
    sys.stdout.buffer.write(image_data)
