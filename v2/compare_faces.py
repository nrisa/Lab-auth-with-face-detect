import sys
import cv2
import numpy as np

def compare_faces(image1_path, image2_path):
    # Load the images
    image1 = cv2.imread(image1_path)
    image2 = cv2.imread(image2_path)

    # Convert images to grayscale
    gray_image1 = cv2.cvtColor(image1, cv2.COLOR_BGR2GRAY)
    gray_image2 = cv2.cvtColor(image2, cv2.COLOR_BGR2GRAY)

    # Load the Haar Cascade for face detection
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

    # Detect faces in both images
    faces1 = face_cascade.detectMultiScale(gray_image1, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))
    faces2 = face_cascade.detectMultiScale(gray_image2, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    if len(faces1) > 0 and len(faces2) > 0:
        # Use the first detected face in each image for comparison
        x1, y1, w1, h1 = faces1[0]
        x2, y2, w2, h2 = faces2[0]

        # Extract face regions
        face1 = gray_image1[y1:y1+h1, x1:x1+w1]
        face2 = gray_image2[y2:y2+h2, x2:x2+w2]

        # Resize faces to the same size for comparison
        face1_resized = cv2.resize(face1, (100, 100))
        face2_resized = cv2.resize(face2, (100, 100))

        # Compare the faces using template matching
        result = cv2.matchTemplate(face1_resized, face2_resized, cv2.TM_CCOEFF_NORMED)

        # Find the best match value
        _, max_val, _, _ = cv2.minMaxLoc(result)

        # Set a threshold for matching
        threshold = 0.8  # Adjust this threshold based on your needs
        if max_val >= threshold:
            print("Match")
            return 'match'
        else:
            print("Not Match")
            return 'not match'
    else:
        print("No face found")
        return 'no face found'

# Replace with paths to your images
compare_faces("faces/face.png", "faces/profil.png")

# if __name__ == "__main__":
#     if len(sys.argv) != 3:
#         print("Usage: python compare_faces.py <image1_path> <image2_path>")
#         sys.exit(1)

#     image1_path = sys.argv[1]
#     image2_path = sys.argv[2]

#     result = compare_faces(image1_path, image2_path)
#     print(result)


