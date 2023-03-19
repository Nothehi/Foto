#!.venv/bin/python

from PIL import Image
import face_recognition
import sys

def getFaces(source):
    image = face_recognition.load_image_file(source)
    face_locations = face_recognition.face_locations(image, number_of_times_to_upsample=0, model="cnn")

    for idx, face_location in enumerate(face_locations):
        top, right, bottom, left = face_location
        face_image = image[top:bottom, left:right]
        pil_image = Image.fromarray(face_image)
        pil_image.save("p-{}.jpg".format(idx), 'JPEG')

def compareFace(face, picture):
    face = face_recognition.load_image_file(face)
    picture = face_recognition.load_image_file(picture)

    # Get the face encodings for each face in each image file
    # Since there could be more than one face in each image, it returns a list of encodings.
    # But since I know each image only has one face, I only care about the first encoding in each image, so I grab index 0.
    try:
        face_encoding = face_recognition.face_encodings(face)[0]
        picture_encoding = face_recognition.face_encodings(picture)
    except IndexError:
        print("I wasn't able to locate any faces in at least one of the images. Check the image files. Aborting...")
        quit()

    known_faces = [
        face_encoding,
    ]

    # results is an array of True/False telling if the unknown face matched anyone in the known_faces array
    # return face_recognition.compare_faces(known_faces, picture_encoding)
    for unknown_face in picture_encoding:
        if (face_recognition.compare_faces(known_faces, unknown_face)[0]):
            return True

    return False


# getFaces(sys.argv[1])
print(compareFace(sys.argv[1], sys.argv[2]))