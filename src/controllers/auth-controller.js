const User = require("../models/auth-models");
const bcrypt = require("bcryptjs");

const register = async (req, res) => {
  const { name, email, password } = req.body;

  //  validation
  let errors = [];

  if (!name) errors.push({ message: name, field: "name is required" });
  if (!email) errors.push({ message: email, field: "email is required" });
  if (!password)
    errors.push({ message: password, field: "password is required" });

  if (errors.length > 0) return res.status(404).json(errors);

  try {
    const emailExists = await User.emailIfExists(email);
    if (emailExists)
      return res.status(400).json({ message: "Email already exists" });

    const salt = await bcrypt.genSalt(10);
    const hashedPassword = await bcrypt.hash(password, salt);

    try {
      await User.createUser(name, email, hashedPassword);
    } catch (error) {
      console.log(error);
    }

    res.status(201).json({
      message: "User has been created successfully",
    });
  } catch (error) {
    console.log(error);
  }
};

module.exports = { register };
